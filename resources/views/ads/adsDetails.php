 
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>جزئیات آگهی امتیاز وام | مستر وام</title>

<link rel="stylesheet" href="<?= asset('cdn/Vazirmatn-font-face.css') ?>">
@vite(['resources/css/app.css', 'resources/css/landing.css', 'resources/js/app.js'])

<script>
  tailwind.config = {
    theme: {
      extend: {
        fontFamily: { vazir: ['Vazirmatn', 'sans-serif'] },
        colors: {
          teal: { 950:'#062825',900:'#0a3733',800:'#0d4a44',700:'#0e6a60',600:'#0f9c8c',500:'#14b3a0',400:'#3ecbb8',100:'#e3f7f3',50:'#f1fbf9' },
          ink:  { 900:'#152238',800:'#1e2b44',600:'#4b5875',400:'#8592ab' }
        },
        keyframes: {
          fadeUp: { '0%': { opacity:0, transform:'translateY(20px)' }, '100%': { opacity:1, transform:'translateY(0)' } },
          shimmer: { '0%': { backgroundPosition:'-400px 0' }, '100%': { backgroundPosition:'400px 0' } },
        },
        animation: {
          fadeUp: 'fadeUp .6s cubic-bezier(.22,1,.36,1) both',
          shimmer: 'shimmer 1.4s infinite linear',
        }
      }
    }
  }
</script>

<style>
  html { scroll-behavior: smooth; }
  body { font-family: 'Vazirmatn', sans-serif; }
  [x-cloak] { display: none !important; }
  .stagger > * { animation: fadeUp .6s cubic-bezier(.22,1,.36,1) both; }
  .stagger > *:nth-child(1){animation-delay:.03s} .stagger > *:nth-child(2){animation-delay:.07s}
  .stagger > *:nth-child(3){animation-delay:.11s} .stagger > *:nth-child(4){animation-delay:.15s}
  .stagger > *:nth-child(5){animation-delay:.19s}
  .card-hover { transition: transform .3s cubic-bezier(.22,1,.36,1), box-shadow .3s ease; }
  .card-hover:hover { transform: translateY(-6px); box-shadow: 0 20px 40px -18px rgba(15,156,140,.3); }
  .skeleton { background: linear-gradient(90deg,#eef4f3 25%,#f7fbfa 37%,#eef4f3 63%); background-size:400px 100%; animation: shimmer 1.4s infinite linear; }
  .btn-shine { position: relative; overflow: hidden; }
  .btn-shine::after { content:''; position:absolute; inset:0; background:linear-gradient(120deg, transparent 30%, rgba(255,255,255,.35) 50%, transparent 70%); transform:translateX(-120%); transition:transform .7s ease; }
  .btn-shine:hover::after { transform: translateX(120%); }
  ::-webkit-scrollbar { width: 7px; }
  ::-webkit-scrollbar-thumb { background: #cdeee8; border-radius: 8px; }
</style>
</head>

<body class="bg-white text-ink-900 antialiased" x-data="listingDetailApp()" x-init="init()">

<!-- ============ HEADER (same as home/listing pages) ============ -->
<?= view('components.landing.header')->render(); ?>

<!-- ============ BREADCRUMB ============ -->
<div class="max-w-[1180px] mx-auto px-5 pt-6 text-[13px] text-ink-400 flex items-center gap-1.5 flex-wrap">
  <a href="/" class="hover:text-teal-600">خانه</a>
  <span>/</span>
  <a href="listings.html" class="hover:text-teal-600">آگهی ها</a>
  <span>/</span>
  <span class="text-ink-700" x-text="loading ? 'در حال بارگذاری...' : listing?.title"></span>
</div>

<!-- ============ LOADING SKELETON ============ -->
<section x-cloak x-show="loading" class="max-w-[1180px] mx-auto px-5 py-8 grid lg:grid-cols-[380px_1fr] gap-8">
  <div class="h-[420px] rounded-2xl skeleton"></div>
  <div class="h-[420px] rounded-2xl skeleton"></div>
</section>

<!-- ============ NOT FOUND ============ -->
<section x-cloak x-show="!loading && !listing" class="max-w-[1180px] mx-auto px-5 py-24 text-center">
  <p class="text-[18px] font-bold text-ink-800">این آگهی پیدا نشد</p>
  <p class="text-[13.5px] text-ink-400 mt-1">ممکن است حذف شده یا آدرس اشتباه باشد</p>
  <a href="listings.html" class="inline-block mt-5 text-teal-600 font-semibold hover:underline">بازگشت به لیست آگهی‌ها</a>
</section>

<!-- ============ MAIN CONTENT ============ -->
<section x-cloak x-show="!loading && listing" class="max-w-[1180px] mx-auto px-5 py-8">
  <div class="grid lg:grid-cols-[380px_1fr] gap-8 items-start stagger">

    <!-- ============ RIGHT: PRICE / CTA / SELLER CARD (sticky) ============ -->
    <aside class="lg:sticky lg:top-24 space-y-5">
      <?= view('components.ads.detail.price-cta')->render(); ?>
    </aside>

    <!-- ============ LEFT: FULL DETAILS ============ -->
    <div>
      <?= view('components.ads.detail.full-details')->render(); ?>
    </div>
  </div>

  <?= view('components.ads.detail.similar-listings')->render(); ?>
</section>

<!-- ============ FOOTER (same as home/listing pages) ============ -->
<?= view('components.landing.footer')->render(); ?>

<script>
function listingDetailApp() {
  return {
    mobileMenu: false,
    loading: true,
    loadingSeller: true,
    listing: null,
    sellerListings: [],

    init() {
      const params = new URLSearchParams(window.location.search);
      const id = Number(params.get('id')) || 1;
      this.fetchListingDetail(id);
    },

    goToLogin() { window.location.href = '/user/login'; },
    goToRegister() { window.location.href = '/user/register'; },
    goToListing(id) { window.location.href = `listing-detail.html?id=${id}`; },
    startNegotiation() { window.location.href = '/dashboard'; }, // TODO: مسیر داشبورد واقعی را در صورت نیاز عوض کن

    formatToman(n) { return n ? Number(n).toLocaleString('en-US') : ''; },

    transactionTypeLabel(type) {
      const map = { escrow: 'معامله با Escrow', vip_no_escrow: 'VIP بدون Escrow', in_person: 'فقط حضوری', online: 'فقط آنلاین' };
      return map[type] || '';
    },

    get detailRows() {
      if (!this.listing) return [];
      const l = this.listing;
      return [
        { label: 'بانک', value: l.bankName },
        { label: 'طرح وام', value: l.plan },
        { label: 'مبلغ وام', value: this.formatToman(l.loanAmount) + ' تومان' },
        { label: 'قیمت فروش امتیاز', value: this.formatToman(l.scorePrice) + ' تومان' },
        { label: 'نرخ سود', value: l.profitRate + '٪' },
        { label: 'تعداد اقساط', value: l.repaymentMonths + ' قسط' },
        { label: 'مدت بازپرداخت', value: l.repaymentMonths + ' ماه' },
        { label: 'مبلغ هر قسط', value: this.formatToman(l.installmentAmount) + ' تومان' },
        { label: 'استان', value: l.province },
        { label: 'شهر', value: l.city },
        { label: 'امتیاز فروشنده', value: l.seller.rating + ' از ۵' },
        { label: 'نوع معامله', value: this.transactionTypeLabel(l.transactionType) },
      ];
    },

    // =================================================================
    // API INTEGRATION (Axios)
    // -----------------------------------------------------------------
    // فعلاً روی داده‌ی تستی کار می‌کند. برای اتصال API واقعی:
    //   1) USE_TEST_DATA را false کن
    //   2) API_BASE را ست کن
    // Endpoint contract (پیشنهادی):
    //   GET {API_BASE}/api/v1/listings/{id}                     -> جزئیات یک آگهی
    //   GET {API_BASE}/api/v1/sellers/{sellerId}/listings        -> آخرین ۵ آگهی همان فروشنده
    //        params: { limit: 5, exclude: id }
    // =================================================================
    async fetchListingDetail(id) {
      const USE_TEST_DATA = true;                    // ← وقتی API آماده شد: false
      const API_BASE = 'https://api.example.com';    // ← آدرس API واقعی

      this.loading = true;

      if (USE_TEST_DATA) {
        await new Promise((r) => setTimeout(r, 400));
        const pool = this.demoPool();
        this.listing = pool.find((x) => x.id === id) || pool[0];
        this.loading = false;
        this.fetchSellerListings(this.listing.sellerId, this.listing.id);
        return;
      }

      try {
        const { data } = await axios.get(`${API_BASE}/api/v1/listings/${id}`);
        this.listing = this.mapListing(data.data ?? data);
        this.fetchSellerListings(this.listing.sellerId, this.listing.id);
      } catch (err) {
        console.error('خطا در دریافت جزئیات آگهی:', err);
        this.listing = null;
      } finally {
        this.loading = false;
      }
    },

    async fetchSellerListings(sellerId, excludeId) {
      const USE_TEST_DATA = true;                    // ← وقتی API آماده شد: false
      const API_BASE = 'https://api.example.com';    // ← آدرس API واقعی

      this.loadingSeller = true;

      if (USE_TEST_DATA) {
        await new Promise((r) => setTimeout(r, 350));
        const pool = this.demoPool();
        this.sellerListings = pool
          .filter((x) => x.sellerId === sellerId && x.id !== excludeId)
          .sort((a, b) => b.id - a.id)
          .slice(0, 5);
        this.loadingSeller = false;
        return;
      }

      try {
        const { data } = await axios.get(`${API_BASE}/api/v1/sellers/${sellerId}/listings`, {
          params: { limit: 5, exclude: excludeId },
        });
        this.sellerListings = (data.data || []).map(this.mapListing);
      } catch (err) {
        console.error('خطا در دریافت آگهی‌های دیگر فروشنده:', err);
        this.sellerListings = [];
      } finally {
        this.loadingSeller = false;
      }
    },

    mapListing(item) {
      return {
        id: item.id,
        sellerId: item.seller_id,
        title: item.title,
        plan: item.plan,
        bankName: item.bank_name,
        bankInitial: (item.bank_name || item.title || '?').trim()[0],
        color: item.color || 'bg-teal-500',
        loanAmount: item.loan_amount,
        scorePrice: item.score_price,
        profitRate: item.profit_rate,
        repaymentMonths: item.repayment_months,
        installmentAmount: item.installment_amount,
        province: item.province,
        city: item.city,
        urgent: item.urgent,
        vip: item.vip,
        guaranteed: item.guaranteed,
        negotiable: item.negotiable,
        contractReady: item.contract_ready,
        fullDocs: item.full_docs,
        transactionType: item.transaction_type,
        description: item.description,
        views: item.views,
        contacts: item.contacts,
        createdAtLabel: item.created_at_label,
        seller: item.seller,
      };
    },

    // -----------------------------------------------------------------
    // TEST DATA — فقط برای نمایش؛ با اتصال API واقعی حذف/نادیده گرفته می‌شود
    // -----------------------------------------------------------------
    demoPool() {
      const banks = [
        { name: 'بانک ملی', plan: 'مهربانی', color: 'bg-emerald-500' },
        { name: 'بانک ملت', plan: 'طرح رفاه ملت', color: 'bg-red-400' },
        { name: 'بانک رسالت', plan: 'قرض‌الحسنه', color: 'bg-sky-500' },
        { name: 'بانک صادرات', plan: 'طرح صادرات کارت', color: 'bg-blue-400' },
        { name: 'بانک سامان', plan: 'طرح سامان کارت', color: 'bg-amber-400' },
        { name: 'بانک پارسیان', plan: 'طرح پارسیان پلاس', color: 'bg-purple-400' },
        { name: 'بانک آینده', plan: 'طرح آینده‌سازان', color: 'bg-teal-500' },
        { name: 'بانک مسکن', plan: 'وام ودیعه مسکن', color: 'bg-rose-400' },
      ];
      const cities = [
        { p: 'تهران', c: 'تهران' }, { p: 'اصفهان', c: 'اصفهان' }, { p: 'فارس', c: 'شیراز' },
        { p: 'خراسان رضوی', c: 'مشهد' }, { p: 'آذربایجان شرقی', c: 'تبریز' }, { p: 'البرز', c: 'کرج' },
      ];
      const sellers = [
        { id: 1, name: 'محمد رضایی', rating: 4.8, verified: true, vip: true, activeAdsCount: 12, joinedAt: '۱۴۰۲' },
        { id: 2, name: 'سارا احمدی', rating: 4.2, verified: true, vip: false, activeAdsCount: 6, joinedAt: '۱۴۰۱' },
        { id: 3, name: 'علی کریمی', rating: 3.9, verified: false, vip: false, activeAdsCount: 3, joinedAt: '۱۴۰۳' },
        { id: 4, name: 'زهرا موسوی', rating: 5.0, verified: true, vip: true, activeAdsCount: 20, joinedAt: '۱۴۰۰' },
      ];

      const items = [];
      for (let i = 1; i <= 42; i++) {
        const bank = banks[i % banks.length];
        const loc = cities[i % cities.length];
        const seller = sellers[i % sellers.length];
        items.push({
          id: i,
          sellerId: seller.id,
          seller,
          title: `وام ${['مسکن', 'خودرو', 'شخصی', 'کسب و کار'][i % 4]} - ${bank.name}`,
          plan: bank.plan,
          bankName: bank.name,
          bankInitial: bank.name[4] || bank.name[0],
          color: bank.color,
          loanAmount: 50000000 + (i % 10) * 90000000,
          scorePrice: 5000000 + (i % 12) * 24000000,
          profitRate: (i % 7) * 4,
          repaymentMonths: [10, 12, 18, 24, 36, 48, 60][i % 7],
          installmentAmount: 500000 + (i % 10) * 4500000,
          province: loc.p,
          city: loc.c,
          urgent: i % 5 === 0,
          vip: i % 4 === 0,
          guaranteed: i % 6 === 0,
          transactionType: ['escrow', 'vip_no_escrow', 'in_person', 'online'][i % 4],
          negotiable: i % 3 === 0,
          contractReady: i % 2 === 0,
          fullDocs: i % 2 === 1,
          description: `این آگهی مربوط به امتیاز وام ${['مسکن', 'خودرو', 'شخصی', 'کسب و کار'][i % 4]} از ${bank.name} با طرح ${bank.plan} است. امتیاز این وام به‌صورت کامل و قانونی قابل انتقال بوده و از طریق مراجع رسمی بانک به خریدار منتقل می‌شود. فروشنده آماده مذاکره درباره شرایط پرداخت و زمان انتقال است.`,
          views: 80 + i * 7,
          contacts: 3 + (i % 15),
          createdAtLabel: ['امروز', 'دیروز', '۳ روز پیش', '۱ هفته پیش'][i % 4],
        });
      }
      return items;
    },
  };
}
</script>

</body>
</html>
