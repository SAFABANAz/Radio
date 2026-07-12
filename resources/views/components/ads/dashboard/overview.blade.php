<template x-if="activeItem === 'نمای کلی'">
  <div>
    <div class="mb-6 animate-fadeUp">
      <h1 class="text-[21px] sm:text-[24px] font-extrabold text-ink-900">سلام، <span x-text="user.name"></span> 👋</h1>
      <p class="text-[13.5px] text-ink-400 mt-1">خلاصه‌ای از وضعیت حساب و فعالیت‌های اخیر شما</p>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-7 stagger">
      <button @click="selectItem('ads', 'ثبت آگهی جدید')" class="card-hover bg-teal-600 text-white rounded-2xl p-4 text-right hover:bg-teal-700 transition-colors">
        <svg class="w-5 h-5 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        <p class="text-[12.5px] font-bold">ثبت آگهی جدید</p>
      </button>
      <button @click="selectItem('kyc', 'وضعیت احراز هویت')" class="card-hover bg-white border border-gray-100 rounded-2xl p-4 text-right">
        <svg class="w-5 h-5 mb-2 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-[12.5px] font-bold text-ink-800">احراز هویت</p>
      </button>
      <button @click="selectItem('wallet', 'واریز')" class="card-hover bg-white border border-gray-100 rounded-2xl p-4 text-right">
        <svg class="w-5 h-5 mb-2 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.66 0-3 .9-3 2s1.34 2 3 2 3 .9 3 2-1.34 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 10v2"/></svg>
        <p class="text-[12.5px] font-bold text-ink-800">شارژ کیف پول</p>
      </button>
      <button @click="selectItem('support', 'ثبت تیکت')" class="card-hover bg-white border border-gray-100 rounded-2xl p-4 text-right">
        <svg class="w-5 h-5 mb-2 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        <p class="text-[12.5px] font-bold text-ink-800">پشتیبانی</p>
      </button>
    </div>

    <div x-cloak x-show="loadingStats" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 mb-7">
      <template x-for="i in 6" :key="i"><div class="h-[92px] rounded-2xl skeleton"></div></template>
    </div>
    <div x-cloak x-show="!loadingStats" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 mb-7 stagger">
      <template x-for="s in stats" :key="s.label">
        <div class="card-hover bg-white border border-gray-100 rounded-2xl p-4">
          <div class="w-8 h-8 rounded-lg flex items-center justify-center mb-2" :class="s.bg" x-html="s.icon"></div>
          <p class="text-[15px] font-extrabold text-ink-900" x-text="s.value"></p>
          <p class="text-[11px] text-ink-400 mt-0.5" x-text="s.label"></p>
        </div>
      </template>
    </div>

    <div class="bg-white border border-gray-100 rounded-2xl p-5">
      <p class="font-bold text-[15px] text-ink-900 mb-4">فعالیت‌های اخیر</p>

      <div x-cloak x-show="loadingActivity" class="space-y-3">
        <template x-for="i in 4" :key="i"><div class="h-[52px] rounded-xl skeleton"></div></template>
      </div>

      <div x-cloak x-show="!loadingActivity" class="space-y-1 stagger">
        <template x-for="(act, idx) in activity" :key="idx">
          <div class="flex items-start gap-3 py-3 border-b border-gray-50 last:border-0">
            <div class="w-9 h-9 rounded-full flex items-center justify-center shrink-0" :class="act.bg" x-html="act.icon"></div>
            <div class="min-w-0 flex-1">
              <p class="text-[13px] text-ink-800" x-text="act.text"></p>
              <p class="text-[11px] text-ink-400 mt-0.5" x-text="act.time"></p>
            </div>
          </div>
        </template>
      </div>
    </div>
  </div>
</template>
