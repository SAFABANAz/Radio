<header class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-gray-100">
    <div class="max-w-[1180px] mx-auto px-5 h-[76px] flex items-center justify-between">
        <a href="/" class="flex items-center gap-2 shrink-0">
            <span class="text-[19px] font-extrabold text-ink-900">مستر وام</span>
            <svg width="34" height="34" viewBox="0 0 34 34" fill="none">
                <rect x="1" y="1" width="32" height="32" rx="9" fill="#0f9c8c"/>
                <path d="M9 22V12l8-4 8 4v10" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9 22h16" stroke="white" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </a>

        <nav class="hidden lg:flex items-center gap-8 text-[14.5px] text-ink-800 font-medium">
            <a href="#" @click.prevent="window.scrollTo({top:0,behavior:'smooth'})" class="hover:text-teal-600 transition-colors">خانه</a>
            <a href="#" @click.prevent="goToLoans()" class="hover:text-teal-600 transition-colors">آگهی ها</a>
            <a href="#" @click.prevent="goToGuide()" class="hover:text-teal-600 transition-colors">راهنما</a>
            <a href="#" @click.prevent="goToAbout()" class="hover:text-teal-600 transition-colors">درباره ما</a>
            <a href="#" @click.prevent="goToContact()" class="hover:text-teal-600 transition-colors">تماس با ما</a>
            <a href="#" @click.prevent="goToBlog()" class="hover:text-teal-600 transition-colors">وبلاگ</a>
        </nav>

        <div class="flex items-center gap-3">
            <button @click="goToRegister()"
                class="hidden sm:inline-flex text-[14px] font-semibold px-5 py-2.5 rounded-xl border border-gray-300 text-ink-800 hover:border-teal-500 hover:text-teal-600 transition-colors">
                ثبت نام
            </button>
            <button @click="goToLogin()"
                class="btn-shine text-[14px] font-semibold px-5 py-2.5 rounded-xl bg-ink-900 text-white hover:bg-teal-700 transition-colors">
                ورود
            </button>
            <button class="lg:hidden p-2 text-ink-800" @click="mobileMenu = !mobileMenu">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round"/></svg>
            </button>
        </div>
    </div>

    <div x-cloak x-show="mobileMenu" x-transition class="lg:hidden border-t border-gray-100 px-5 py-4 flex flex-col gap-4 text-[14.5px] font-medium">
        <a href="#" @click.prevent="window.scrollTo({top:0,behavior:'smooth'})">خانه</a>
        <a href="#" @click.prevent="goToLoans()">آگهی ها</a>
        <a href="#" @click.prevent="goToGuide()">راهنما</a>
        <a href="#" @click.prevent="goToAbout()">درباره ما</a>
        <a href="#" @click.prevent="goToContact()">تماس با ما</a>
        <a href="#" @click.prevent="goToBlog()">وبلاگ</a>
        <button @click="goToRegister()" class="text-right border border-gray-300 rounded-xl py-2.5 font-semibold">ثبت نام</button>
    </div>
</header>
