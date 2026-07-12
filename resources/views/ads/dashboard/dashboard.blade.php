<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد کاربری | مستر وام</title>

    <link rel="stylesheet" href="{{ asset('cdn/Vazirmatn-font-face.css') }}">
    @vite(['resources/css/app.css', 'resources/css/landing.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Vazirmatn', sans-serif; }
        [x-cloak] { display: none !important; }
        .stagger > * { animation: fadeUp .55s cubic-bezier(.22,1,.36,1) both; }
        .stagger > *:nth-child(1){animation-delay:.02s} .stagger > *:nth-child(2){animation-delay:.06s}
        .stagger > *:nth-child(3){animation-delay:.10s} .stagger > *:nth-child(4){animation-delay:.14s}
        .stagger > *:nth-child(5){animation-delay:.18s} .stagger > *:nth-child(6){animation-delay:.22s}
        .card-hover { transition: transform .3s cubic-bezier(.22,1,.36,1), box-shadow .3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 16px 32px -16px rgba(15,156,140,.25); }
        .skeleton { background: linear-gradient(90deg,#eef4f3 25%,#f7fbfa 37%,#eef4f3 63%); background-size:400px 100%; animation: shimmer 1.4s infinite linear; }
        .sidebar-scroll::-webkit-scrollbar { width: 5px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: #d7ece8; border-radius: 8px; }
        ::-webkit-scrollbar { width: 7px; }
        ::-webkit-scrollbar-thumb { background: #cdeee8; border-radius: 8px; }
    </style>
</head>

<body class="bg-gray-50/60 text-ink-900 antialiased" x-data="dashboardApp()" x-init="init()">

<div class="flex h-screen overflow-hidden">
    @include('components.ads.dashboard.sidebar')

    <div class="flex-1 flex flex-col min-w-0">
        @include('components.ads.dashboard.topbar')

        <main class="flex-1 overflow-y-auto p-5 sm:p-7">
            @include('components.ads.dashboard.overview')
            @include('components.ads.dashboard.placeholder')
        </main>
    </div>
</div>

<script>
function dashboardApp() {
  return {
    sidebarOpen: false,
    loadingUser: true,
    loadingStats: true,
    loadingActivity: true,
    notificationsCount: 3,

    activeGroupId: 'dashboard',
    activeItem: 'نمای کلی',

    openGroups: {
      dashboard: true,
      account: false,
      kyc: false,
      ads: false,
      search: false,
      negotiations: false,
      orders: false,
      wallet: false,
      escrow: false,
      contracts: false,
      messages: false,
      ratings: false,
      disputes: false,
      documents: false,
      notifications: false,
      support: false,
    },

    user: { name: '', avatarInitial: '', verified: false, vip: false, score: 0, walletBalance: 0 },
    stats: [],
    activity: [],

    navGroups: [
      { id: 'dashboard', icon: '🏠', label: 'داشبورد', items: ['نمای کلی', 'فعالیت‌های اخیر', 'آمار حساب'] },
      { id: 'account', icon: '👤', label: 'حساب کاربری', items: ['پروفایل', 'اطلاعات شخصی', 'حساب‌های بانکی', 'تنظیمات حساب', 'امنیت حساب'] },
      { id: 'kyc', icon: '🪪', label: 'احراز هویت', items: ['وضعیت احراز هویت', 'ارسال مدارک', 'امضا و اقرارنامه', 'تاریخچه بررسی'] },
      { id: 'ads', icon: '📢', label: 'آگهی‌ها', items: ['همه آگهی‌های من', 'ثبت آگهی جدید', 'پیش‌نویس‌ها', 'آگهی‌های فعال', 'آگهی‌های آرشیو شده'] },
      { id: 'search', icon: '🔍', label: 'جستجوی آگهی', items: ['همه آگهی‌ها', 'علاقه‌مندی‌ها', 'مقایسه آگهی‌ها'] },
      { id: 'negotiations', icon: '🤝', label: 'مذاکرات', items: ['مذاکرات دریافتی', 'مذاکرات ارسالی', 'پیشنهادهای قیمت'] },
      { id: 'orders', icon: '📦', label: 'سفارش‌ها', items: ['سفارش‌های خرید', 'سفارش‌های فروش', 'سفارش‌های در حال انجام', 'سفارش‌های تکمیل‌شده', 'سفارش‌های لغوشده'] },
      { id: 'wallet', icon: '💰', label: 'کیف پول', items: ['موجودی', 'تراکنش‌ها', 'واریز', 'برداشت', 'گزارش مالی'] },
      { id: 'escrow', icon: '🔒', label: 'معاملات امانی', items: ['معاملات فعال', 'تاریخچه معاملات', 'وضعیت آزادسازی وجه'] },
      { id: 'contracts', icon: '📄', label: 'قراردادها', items: ['قراردادهای فعال', 'قراردادهای تکمیل‌شده', 'دانلود قراردادها'] },
      { id: 'messages', icon: '💬', label: 'پیام‌ها', items: ['گفتگوها', 'فایل‌های ارسالی', 'آرشیو پیام‌ها'] },
      { id: 'ratings', icon: '⭐', label: 'امتیازات', items: ['امتیاز من', 'نظرات کاربران', 'تاریخچه امتیازها'] },
      { id: 'disputes', icon: '⚖', label: 'شکایات و داوری', items: ['ثبت شکایت', 'شکایت‌های من', 'پرونده‌های داوری'] },
      { id: 'documents', icon: '📁', label: 'اسناد', items: ['مدارک من', 'فایل‌های بارگذاری‌شده', 'قراردادها'] },
      { id: 'notifications', icon: '🔔', label: 'اعلان‌ها', items: ['اعلان‌های سیستم', 'پیامک‌ها', 'اطلاعیه‌ها'] },
      { id: 'support', icon: '❓', label: 'پشتیبانی', items: ['ثبت تیکت', 'تیکت‌های من', 'سوالات متداول'] },
    ],

    init() {
      this.fetchCurrentUser();
      this.fetchDashboardStats();
      this.fetchRecentActivity();
    },

    get activeGroupLabel() {
      const g = this.navGroups.find((g) => g.id === this.activeGroupId);
      return g ? g.label : '';
    },
    get activeGroupIcon() {
      const g = this.navGroups.find((g) => g.id === this.activeGroupId);
      return g ? g.icon : '📄';
    },

    toggleGroup(id) {
      Object.keys(this.openGroups).forEach((key) => {
        this.openGroups[key] = key === id ? !this.openGroups[key] : false;
      });
    },

    isGroupActive(id) {
      return this.activeGroupId === id;
    },

    selectItem(groupId, item) {
      this.activeGroupId = groupId;
      this.activeItem = item;
      Object.keys(this.openGroups).forEach((key) => {
        this.openGroups[key] = key === groupId;
      });
      this.sidebarOpen = false;
    },

    formatToman(n) { return Number(n || 0).toLocaleString('en-US') + ' تومان'; },

    logout() {
      window.location.href = '/user/login';
    },

    async fetchCurrentUser() {
      const USE_TEST_DATA = true;
      const API_BASE = 'https://api.example.com';
      this.loadingUser = true;

      if (USE_TEST_DATA) {
        await new Promise((r) => setTimeout(r, 350));
        this.user = { name: 'محمد رضایی', avatarInitial: 'م', verified: true, vip: true, score: 850, walletBalance: 42500000 };
        this.loadingUser = false;
        return;
      }

      try {
        const { data } = await axios.get(`${API_BASE}/api/v1/me`);
        const u = data.data ?? data;
        this.user = { name: u.name, avatarInitial: (u.name || '?')[0], verified: u.verified, vip: u.vip, score: u.score, walletBalance: u.wallet_balance };
      } catch (err) {
        console.error('خطا در دریافت اطلاعات کاربر:', err);
      } finally {
        this.loadingUser = false;
      }
    },

    async fetchDashboardStats() {
      const USE_TEST_DATA = true;
      const API_BASE = 'https://api.example.com';
      this.loadingStats = true;

      if (USE_TEST_DATA) {
        await new Promise((r) => setTimeout(r, 450));
        this.stats = [
          { label: 'آگهی‌های فعال', value: '۱۲', bg: 'bg-teal-50 text-teal-600', icon: '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M9 8h6M5 4h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 011-1z"/></svg>' },
          { label: 'موجودی کیف پول', value: '۴۲.۵ میلیون', bg: 'bg-emerald-50 text-emerald-600', icon: '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.66 0-3 .9-3 2s1.34 2 3 2 3 .9 3 2-1.34 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 10v2"/></svg>' },
          { label: 'امتیاز من', value: '۸۵۰', bg: 'bg-amber-50 text-amber-600', icon: '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.05 2.93a1 1 0 011.9 0l1.36 2.76 3.04.44a1 1 0 01.56 1.7l-2.2 2.15.52 3.03a1 1 0 01-1.45 1.05L10 12.6l-2.72 1.43a1 1 0 01-1.45-1.05l.52-3.03-2.2-2.15a1 1 0 01.56-1.7l3.04-.44 1.36-2.76z"/></svg>' },
          { label: 'مذاکرات باز', value: '۴', bg: 'bg-sky-50 text-sky-600', icon: '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2v-1"/></svg>' },
          { label: 'سفارش‌های در جریان', value: '۲', bg: 'bg-purple-50 text-purple-600', icon: '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>' },
          { label: 'پیام‌های خوانده‌نشده', value: '۶', bg: 'bg-rose-50 text-rose-600', icon: '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h8m-8 4h5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>' },
        ];
        this.loadingStats = false;
        return;
      }

      try {
        const { data } = await axios.get(`${API_BASE}/api/v1/dashboard/stats`);
        this.stats = data.data ?? data;
      } catch (err) {
        console.error('خطا در دریافت آمار داشبورد:', err);
        this.stats = [];
      } finally {
        this.loadingStats = false;
      }
    },

    async fetchRecentActivity() {
      const USE_TEST_DATA = true;
      const API_BASE = 'https://api.example.com';
      this.loadingActivity = true;

      if (USE_TEST_DATA) {
        await new Promise((r) => setTimeout(r, 500));
        this.activity = [
          { text: 'آگهی «وام مسکن - بانک ملی» با موفقیت ثبت شد', time: '۱۰ دقیقه پیش', bg: 'bg-teal-50 text-teal-600', icon: '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>' },
          { text: 'پیشنهاد قیمت جدید برای آگهی «وام خودرو - بانک ملت» دریافت شد', time: '۲ ساعت پیش', bg: 'bg-sky-50 text-sky-600', icon: '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2v-1"/></svg>' },
          { text: 'واریز ۵,۰۰۰,۰۰۰ تومانی به کیف پول شما تایید شد', time: 'دیروز', bg: 'bg-emerald-50 text-emerald-600', icon: '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.66 0-3 .9-3 2s1.34 2 3 2 3 .9 3 2-1.34 2-3 2"/></svg>' },
          { text: 'مدارک احراز هویت شما تایید شد', time: '۲ روز پیش', bg: 'bg-amber-50 text-amber-600', icon: '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>' },
        ];
        this.loadingActivity = false;
        return;
      }

      try {
        const { data } = await axios.get(`${API_BASE}/api/v1/dashboard/activity`);
        this.activity = data.data ?? data;
      } catch (err) {
        console.error('خطا در دریافت فعالیت‌های اخیر:', err);
        this.activity = [];
      } finally {
        this.loadingActivity = false;
      }
    },
  };
}
</script>

</body>
</html>
