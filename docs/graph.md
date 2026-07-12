# SHVAM Knowledge Graph

این سند یک معرفی کامل از پروژه `SHVAM` است؛ از معماری کلی تا امکانات اصلی، ماژول‌ها، جریان داده، و وابستگی‌ها.

## ۱. نمای کلی پروژه

- پروژه بر پایه‌ی **Laravel 12** ساخته شده.
- معماری پروژه از نوع **ماژولار مونولیت** است.
- کد در دو فضای نام اصلی قرار دارد:
  - `App\` برای لایه‌ی اپلیکیشن و سرویس‌های پایه
  - `Modules\` برای ماژول‌های دامنه‌ای و سرویس‌های اختصاصی
- بخش `vendor/` وابستگی‌های Composer را نگه می‌دارد.
- پروژه در مسیر `c:\xampp\htdocs\L\LVAM` قرار دارد.

## ۲. نقطه شروع بارگذاری

- فایل اصلی بارگذاری ماژول‌ها: `app/Providers/AppServiceProvider.php`
- این ServiceProvider ماژول‌های پایه و سرویس‌های اصلی را ثبت می‌کند:
  - `Modules\Shared\Providers\SharedServiceProvider`
  - `App\Providers\RepositoryServiceProvider`
  - `App\Providers\UserManagementServiceProvider`
  - `App\Providers\AuthenticationServiceProvider`
  - `Modules\Workflow\Providers\WorkflowServiceProvider`
  - `Modules\Documents\Providers\DocumentsServiceProvider`
  - `Modules\KYC\Providers\KycServiceProvider`
  - `Modules\Ledger\Providers\LedgerServiceProvider`
  - `Modules\Wallet\Providers\WalletServiceProvider`
- فایل ورودی SPA فریمورک Vue: `resources/js/app.ts`
- قالب Blade مشترک برای SPA: `resources/views/app.blade.php`
- shell اپ Vue: `resources/Modules/Shared/App.vue`
- مسیرهای SPA: `resources/Modules/Shared/router.ts`

### ۲.۵. SPA و مسیریابی فرانت‌اند

- `resources/js/app.ts` اپ Vue را بارگذاری می‌کند و `resources/Modules/Shared/App.vue` را mount می‌کند.
- `resources/views/app.blade.php` قالب Blade اصلی است که `#app` را فراهم می‌کند و `@vite(['resources/css/app.css', 'resources/js/app.ts'])` را لود می‌کند.
- روت `/` به `resources/Modules/Dashboard/Pages/LandingPage.vue` نگاشت شده است.
- روت `/users/login` و `/users/register` به `resources/Modules/Authentication/Pages/UserAuthPage.vue` نگاشت شده‌اند.
- روت `/dashboard` به `resources/Modules/Dashboard/Pages/DashboardPage.vue` نگاشت شده است.

## ۳. ساختار کلی ماژول‌ها

هر ماژول معمولاً شامل این بخش‌ها است:

- `Config/` : تنظیمات ماژول
- `Database/Migrations/` : مایگریشن‌های جدول‌ها
- `Models/` : مدل‌های Eloquent
- `Repositories/` : مخازن داده
- `Services/` : لاجیک تجاری
- `Actions/` : اعمال مشخص و قابل ترکیب
- `DTO/` : اشیاء انتقال داده
- `Events/` و `Listeners/` : سیستم رویداد
- `Policies/` : سیاست‌های دسترسی
- `Http/Controllers/` : کنترلرهای API
- `Http/Requests/` : اعتبارسنجی درخواست‌ها
- `Routes/api.php` : مسیرهای اکسپوز شده

## ۴. ماژول‌های اصلی و نقش‌شان

### ۴.۱ Shared

- نوع: پایه‌ای
- مسئولیت: کلاس‌های بنیادی، کانفیگ مشترک، و ابزارهایی که همه‌ی ماژول‌ها از آن استفاده می‌کنند.
- provider: `Modules\Shared\Providers\SharedServiceProvider`

### ۴.۲ Ledger

- نوع: دامنه‌ای / هسته حسابداری
- provider: `Modules\Ledger\Providers\LedgerServiceProvider`
- مسئولیت:
  - پیاده‌سازی **مکانیزم دفتر کل دوتایی (double-entry ledger)**
  - ثبت تراکنش‌های مالی اتمیک
  - محاسبه‌ی مانده‌ها و بازسازی تاریخچه
  - ذخیره‌سازی ژورنال و اسنپ‌شات
- بخش‌های کلیدی:
  - `Services/` شامل: `LedgerService`, `TransactionService`, `AccountingService`, `BalanceService`, `JournalService`
  - `Repositories/` شامل رابط‌ها و پیاده‌سازی‌های Eloquent برای `Account`, `Ledger`, `Balance`, `Journal`
  - `Models/` مانند: `Account`, `LedgerTransaction`, `LedgerEntry`, `AccountBalance`, `BalanceSnapshot`
- مسیر API: `Modules/Ledger/Routes/api.php`
- مایگریشن: `Modules/Ledger/Database/Migrations/2026_07_07_000001_create_ledger_engine_tables.php`

### ۴.۳ Wallet

- نوع: کاربردی / سرویس مالی
- provider: `Modules\Wallet\Providers\WalletServiceProvider`
- مسئولیت:
  - مدیریت کیف پول کاربر
  - نمایش موجودی‌ها و وضعیت‌ها
  - انتقال داخلی و عملیات سپرده/برداشت
  - قفل گذاری مانده و اعمال محدودیت
  - نگهداری تاریخچه تراکنش‌های کیف پول
- تمایز مهم: **موجودی کیف پول هرگز نباید به صورت مستقیم تغییر کند**. تمامی تغییرات مالی باید از طریق `Ledger` ثبت شوند.
- بخش‌های کلیدی:
  - `Services/`: `WalletService`, `BalanceService`, `TransferService`, `WalletLockService`, `WalletLimitService`
  - `Repositories/`: رابط‌ها و Eloquent برای `Wallet`, `WalletBalance`, `WalletTransaction`, `WalletLock`, `WalletLimit`
  - `Models/`: `Wallet`, `WalletBalance`, `WalletTransaction`, `WalletLock`, `WalletLimit`, `WalletSetting`
  - `Enums/`: نوع تراکنش‌ها و وضعیت‌ها
  - `Actions/`: اعمال ایجاد کیف پول، انتقال، قفل، باز کردن قفل و موارد مشابه
- مسیر API: `Modules/Wallet/Routes/api.php`
- مایگریشن: `Modules/Wallet/Database/Migrations/2026_07_08_000001_create_wallet_module_tables.php`

### ۴.۴ UserManagement

- نوع: دامنه‌ای
- provider: `Modules\UserManagement\Providers\UserManagementServiceProvider`
- مسئولیت: مدیریت کاربران، پروفایل‌ها، نقش‌ها، مجوزها و حساب‌های بانکی.
- مسیر API: `Modules/UserManagement/Routes/api.php`
- مایگریشن: `Modules/UserManagement/Database/Migrations/2026_07_07_000001_create_user_management_tables.php`

### ۴.۵ Authentication

- نوع: زیرساختی
- provider wrapper: `App\Providers\AuthenticationServiceProvider`
- provider ماژول: `Modules\Authentication\Providers\AuthenticationServiceProvider`
- مسئولیت: OTP، نشست، تاریخچه ورود، و خدمات امنیتی ارسال پیامک.
- مسیر API: `Modules/Authentication/Routes/api.php`
- مایگریشن: `Modules/Authentication/Database/Migrations/2026_07_07_000001_create_authentication_tables.php`

### ۴.۶ KYC

- نوع: دامنه‌ای
- provider: `Modules\KYC\Providers\KycServiceProvider`
- مسئولیت: جریان درخواست KYC، پروفایل‌های احراز هویت، و وضعیت‌های تایید.
- مسیر API: `Modules/KYC/Routes/api.php`
- مایگریشن: `Modules/KYC/Database/Migrations/2026_07_07_000001_create_kyc_module_tables.php`

### ۴.۷ Documents

- نوع: دامنه‌ای
- provider: `Modules\Documents\Providers\DocumentsServiceProvider`
- مسئولیت: ثبت و مدیریت اسناد، نسخه‌ها، متادیتا، به اشتراک‌گذاری و دسترسی.
- مسیر API: `Modules/Documents/Routes/api.php`
- مایگریشن: `Modules/Documents/Database/Migrations/2026_07_07_000001_create_documents_module_tables.php`

### ۴.۸ Workflow

- نوع: دامنه‌ای
- provider: `Modules\Workflow\Providers\WorkflowServiceProvider`
- مسئولیت: موتور گردش کار، تعریف وضعیت‌ها، مراحل، تاییدیه‌ها، و اجرای جریان‌ها.
- مسیر API: `Modules/Workflow/Routes/api.php`
- مایگریشن: `Modules/Workflow/Database/Migrations/2026_07_07_000001_create_workflow_engine_support_tables.php`

## ۵. قابلیت‌ها و امکانات پروژه

### ۵.۱ امکانات حسابداری و مالی

- دفتر کل دوتایی با اطمینان از تراز دو طرفه.
- ثبت تراکنش‌های اتمیک و برگشت‌پذیر.
- محاسبه و ذخیره اسنپ‌شات مانده حساب.
- پشتیبانی از چند حساب، جریان‌های مختلف مالی و ژورنال حسابداری.

### ۵.۲ امکانات کیف پول

- ایجاد و مدیریت کیف پول کاربر
- محاسبه مانده‌های موجود، بلوکه، در انتظار و کل
- ثبت تراکنش‌های کیف پول با لینک به دفتر کل
- قفل کردن بخشی از موجودی
- تعریف و بررسی محدودیت‌های کیف پول
- پشتیبانی از انواع تراکنش و وضعیت‌ها

### ۵.۳ امکانات کاربر و احراز هویت

- مدیریت کاربران و پروفایل‌ها
- نقش و مجوز
- ورود با OTP یا سازوکار اختصاصی پیامکی
- نگهداری تاریخچه نشست و ورود

### ۵.۴ امکانات KYC و مستندسازی

- ثبت درخواست‌های احراز هویت
- ذخیره پروفایل‌های تأیید کاربر
- مدیریت اسناد و نسخه‌های سند
- ردیابی دسترسی و اشتراک‌گذاری اسناد

### ۵.۵ گردش کار

- تعریف فرآیندهای چند مرحله‌ای
- اجرای خودکار تراكنش‌های وضعیت محور
- اعتبارسنجی شرایط، تاییدیه‌ها و گذارها

## ۶. گردش درخواست و جریان اجرا

1. **ورود درخواست HTTP** به `Routes/api.php` ماژول مربوطه.
2. درخواست به **Controller** مرتبط می‌رسد.
3. کنترلر از **Service** یا **Action** استفاده می‌کند.
4. Service از **Repository**ها برای خواندن و نوشتن داده استفاده می‌کند.
5. داده‌ها در **Models/Eloquent** به دیتابیس نوشته می‌شوند.
6. اگر نیاز باشد، **Event** منتشر و **Listener** یا **Notification** فعال می‌شود.

## ۷. الگوی توسعه و گسترش

- افزودن ماژول جدید باید با `Providers/<Module>ServiceProvider.php` انجام شود.
- هر ماژول باید:
  - از `mergeConfigFrom()` برای بارگذاری کانفیگ استفاده کند.
  - `bind()` و `singleton()` برای وابستگی‌ها ثبت کند.
  - `loadRoutesFrom()` برای مسیرها و `loadMigrationsFrom()` برای مایگریشن‌ها تعریف کند.
- اگر ماژول نیاز به API دارد، مسیرها باید در `Routes/api.php` باشد.
- لاجیک تجاری باید در `Services/` و `Actions/` نگهداری شود.
- قواعد دسترسی در `Policies/` تعریف می‌شوند.

## ۸. رابطه‌ی Wallet و Ledger

- `Ledger` هسته‌ی مالی و **منبع حقیقت نهایی** است.
- `Wallet` باید فقط وضعیت‌های کیف پول را نگهداری کند، نه مانده‌های حساب را مستقیم تغییر دهد.
- برای هر تغییر مالی، `Wallet` از `LedgerService` استفاده می‌کند تا تراکنش دوتایی ثبت شود.
- `Wallet` سپس از نتایج Ledger برای نمایش مانده‌ها استفاده می‌کند.

## ۹. ساختار مسیرها و مایگریشن‌ها

- مسیرهای ماژول‌ها عمدتاً در `Modules/<Module>/Routes/api.php` قرار دارند.
- مایگریشن‌های هر ماژول در `Modules/<Module>/Database/Migrations/` قرار دارد.
- مایگریشن‌های اصلی قابل شناسایی:
  - `Modules/Ledger/Database/Migrations/2026_07_07_000001_create_ledger_engine_tables.php`
  - `Modules/Wallet/Database/Migrations/2026_07_08_000001_create_wallet_module_tables.php`
  - `Modules/KYC/Database/Migrations/2026_07_07_000001_create_kyc_module_tables.php`
  - `Modules/Documents/Database/Migrations/2026_07_07_000001_create_documents_module_tables.php`
  - `Modules/Workflow/Database/Migrations/2026_07_07_000001_create_workflow_engine_support_tables.php`

## ۱۰. نکات مهم برای توسعه‌دهنده جدید

- اولین فایل برای بررسی: `app/Providers/AppServiceProvider.php`
- اگر می‌خواهی ویژگی مالی اضافه کنی، ابتدا `Ledger` را بررسی کن.
- `Wallet` فقط باید از Ledger بخواند و به Ledger بنویسد.
- `Shared` کلاس‌های بنیادی و config مشترک را نگهداری می‌کند.
- مسیرهای API و سرویس‌های ماژول‌ها ساختار استانداردی دارند.

## ۱۱. پیشنهاد برای گسترش آتی

- تکمیل و استانداردسازی `Wallet` برای عملکردهای deposit/withdraw/transfer
- نوشتن تست‌های اتصالی برای پوشش خطی Ledger و Wallet
- اضافه کردن `GraphQL` یا `OpenAPI` برای مستندسازی API
- پیاده‌سازی `event sourcing` یا `audit trail` دقیق‌تر برای تراکنش‌های مالی
- ساخت یک مستند معماری تصویری با `graphviz` یا نمودار سازمانی برای تیم

## ۱۲. نتیجه

این پروژه یک پلتفرم مالی-بازارگاهی با معماری ماژولار است که:
- حالت حسابداری امن و غیرقابل تغییر دارد
- کیف پول کاربر را با اتصال به دفتر کل پشتیبانی می‌کند
- هویتیابی، KYC، مدارک و گردش کار را همزمان مدیریت می‌کند
- توسعه‌پذیر است و می‌توان ماژول‌های جدید را براساس الگوی موجود اضافه کرد

---

> فایل `docs/graph.md` اکنون آماده است و شرح کامل معماری و امکانات کل پروژه را دارد.
