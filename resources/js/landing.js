function siteApp() {
  return {
    mobileMenu: false,
    loadingListings: true,
    listings: [],
    isAuthenticated: false,
    counters: { ads: 0, deals: 0, banks: 0, volume: 0 },
    phoneListings: [
      { id: 1, title: 'وام مسکن - بانک ملت', score: 850, price: 120000000, color: 'bg-red-400' },
      { id: 2, title: 'وام خودرو - بانک صادرات', score: 720, price: 85000000, color: 'bg-blue-400' },
      { id: 3, title: 'وام شخصی - بانک ملی', score: 810, price: 65000000, color: 'bg-amber-400' },
    ],
    steps: [
      { n: 1, title: 'ثبت نام', desc: 'ثبت نام به عنوان سرمایه گذار یا متقاضی را انتخاب کنید', icon: '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>' },
      { n: 2, title: 'انتخاب امتیاز', desc: 'امتیاز وام مورد نظر خود را انتخاب کنید', icon: '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M9 8h6M5 4h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 011-1z"/></svg>' },
      { n: 3, title: 'تماس و توافق', desc: 'با فروشنده تماس بگیرید و شرایط را توافق کنید', icon: '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2v-1M17 8V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h1v4l4-4h5"/></svg>' },
      { n: 4, title: 'انتقال رسمی', desc: 'انتقال امتیاز از طریق مراجع رسمی بانک', icon: '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7l9-4 9 4-9 4-9-4zm0 0v10l9 4m0-14v14m9-14v10l-9 4"/></svg>' },
      { n: 5, title: 'دریافت وام', desc: 'با امتیاز بالاتر، سریع‌تر وام خود را دریافت کنید', icon: '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v8m-4-5l4-3 4 3M5 21h14"/></svg>' },
    ],
    whyUs: [
      { title: 'شفافیت کامل', desc: 'تمامی معاملات شفاف و قابل پیگیری', icon: '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.5 12S6 5 12 5s9.5 7 9.5 7-3.5 7-9.5 7-9.5-7-9.5-7z"/></svg>' },
      { title: 'انتقال امن', desc: 'انتقال امتیاز از طریق مراجع رسمی بانک', icon: '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3l7 4v5c0 5-3.5 8-7 9-3.5-1-7-4-7-9V7l7-4z"/></svg>' },
      { title: 'تنوع بالا', desc: 'دسترسی به امتیازهای وام مختلف از بانک‌های مختلف', icon: '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>' },
      { title: 'صرفه جویی زمان', desc: 'دریافت وام سریع‌تر با امتیاز بالاتر', icon: '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="1.8"><circle cx="12" cy="12" r="9" stroke-linecap="round"/><path stroke-linecap="round" d="M12 7v5l3 3"/></svg>' },
      { title: 'پشتیبانی ۲۴/۷', desc: 'پشتیبانی کامل در تمام مراحل معامله', icon: '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M18 10a6 6 0 10-12 0v4a2 2 0 002 2h1v-6H6a6 6 0 0112 0h-3v6h1a2 2 0 002-2v-4z"/></svg>' },
    ],
    banks: [
      { name: 'بانک ملت', initial: 'م', color: 'bg-red-50 text-red-600' },
      { name: 'بانک صادرات ایران', initial: 'ص', color: 'bg-blue-50 text-blue-600' },
      { name: 'بانک ملی ایران', initial: 'ملی', color: 'bg-emerald-50 text-emerald-600' },
      { name: 'بانک پارسیان', initial: 'پ', color: 'bg-purple-50 text-purple-600' },
      { name: 'بانک سامان', initial: 'س', color: 'bg-amber-50 text-amber-600' },
      { name: 'بانک آینده', initial: 'آ', color: 'bg-sky-50 text-sky-600' },
    ],

    init() {
      this.checkAuthentication();
      this.animateCounters();
      this.fetchLatestListings();
    },

    async checkAuthentication() {
      try {
        const { data } = await axios.get('/api/user', {
          headers: { Accept: 'application/json' },
        });
        if (data && data.id) {
          this.isAuthenticated = true;
          this.user = data;
        } else {
          this.isAuthenticated = false;
          this.user = null;
        }
      } catch (err) {
        this.isAuthenticated = false;
        this.user = null;
      }
    },

    goToDashboard() { window.location.href = '/dashboard'; },

    goToLogin() { window.location.href = '/users/login'; },
    goToRegister() { window.location.href = '/users/register'; },
    logout() {
      localStorage.removeItem('user_authenticated');
      window.location.href = '/users/logout';
    },
    goToLoans() { window.location.href = '/ads/loadLoans'; },
    goToGuide() { document.getElementById('how-it-works')?.scrollIntoView({ behavior: 'smooth', block: 'start' }); },
    goToAbout() { document.getElementById('why-us')?.scrollIntoView({ behavior: 'smooth', block: 'start' }); },
    goToContact() { document.getElementById('cta')?.scrollIntoView({ behavior: 'smooth', block: 'start' }); },
    goToBlog() { window.location.href = '/'; },

    formatToman(n) { return Number(n).toLocaleString('en-US'); },

    animateCounters() {
      const targets = { ads: 12450, deals: 8250, banks: 45, volume: 1250 };
      const duration = 1400;
      const start = performance.now();
      const step = (now) => {
        const p = Math.min((now - start) / duration, 1);
        const ease = 1 - Math.pow(1 - p, 3);
        this.counters.ads = Math.floor(targets.ads * ease);
        this.counters.deals = Math.floor(targets.deals * ease);
        this.counters.banks = Math.floor(targets.banks * ease);
        this.counters.volume = Math.floor(targets.volume * ease);
        if (p < 1) requestAnimationFrame(step);
      };
      requestAnimationFrame(step);
    },

    async fetchLatestListings() {
      const USE_TEST_DATA = true;
      const API_BASE = 'https://api.example.com';

      this.loadingListings = true;

      if (USE_TEST_DATA) {
        await new Promise((resolve) => setTimeout(resolve, 500));
        this.listings = this.demoListings();
        this.loadingListings = false;
        return;
      }

      try {
        const { data } = await axios.get(`${API_BASE}/api/v1/listings/latest`, {
          params: { limit: 10 },
          headers: { Accept: 'application/json' },
        });
        const items = data?.data ?? data ?? [];
        this.listings = items.map(this.mapListing);
      } catch (err) {
        console.error('خطا در دریافت آخرین آگهی‌ها از API:', err);
        this.listings = this.demoListings();
      } finally {
        this.loadingListings = false;
      }
    },

    mapListing(item) {
      return {
        id: item.id,
        title: item.title,
        bankInitial: (item.bank_name || item.title || '?').trim()[0],
        score: item.score,
        price: item.price,
        city: item.city,
        color: ['bg-red-400','bg-blue-400','bg-amber-400','bg-emerald-500','bg-purple-400'][item.id % 5],
      };
    },

    demoListings() {
      return [
        { id: 1, title: 'وام مسکن - بانک ملت', score: 850, price: 120000000, city: 'تهران', color: 'bg-red-400', bankInitial: 'م' },
        { id: 2, title: 'وام خودرو - بانک صادرات', score: 720, price: 85000000, city: 'اصفهان', color: 'bg-blue-400', bankInitial: 'ص' },
        { id: 3, title: 'وام شخصی - بانک ملی', score: 720, price: 65000000, city: 'شیراز', color: 'bg-emerald-500', bankInitial: 'م' },
        { id: 4, title: 'وام مسکن - بانک پارسیان', score: 850, price: 150000000, city: 'مشهد', color: 'bg-purple-400', bankInitial: 'پ' },
        { id: 5, title: 'وام کسب و کار - بانک سامان', score: 690, price: 95000000, city: 'تبریز', color: 'bg-amber-400', bankInitial: 'س' },
        { id: 6, title: 'وام خودرو - بانک آینده', score: 760, price: 78000000, city: 'کرج', color: 'bg-blue-400', bankInitial: 'آ' },
        { id: 7, title: 'وام مسکن - بانک ملی', score: 810, price: 135000000, city: 'اهواز', color: 'bg-emerald-500', bankInitial: 'م' },
        { id: 8, title: 'وام شخصی - بانک ملت', score: 700, price: 55000000, city: 'قم', color: 'bg-red-400', bankInitial: 'م' },
        { id: 9, title: 'وام خودرو - بانک صادرات', score: 730, price: 88000000, city: 'رشت', color: 'bg-blue-400', bankInitial: 'ص' },
        { id: 10, title: 'وام مسکن - بانک پارسیان', score: 840, price: 145000000, city: 'یزد', color: 'bg-purple-400', bankInitial: 'پ' },
      ];
    },
  };
}

window.siteApp = siteApp;
