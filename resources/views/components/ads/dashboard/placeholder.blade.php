<template x-if="activeItem !== 'نمای کلی'">
  <div class="animate-fadeUp">
    <div class="bg-white border border-dashed border-gray-200 rounded-2xl p-10 text-center">
      <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center mx-auto mb-4 text-[22px]" x-text="activeGroupIcon"></div>
      <p class="font-extrabold text-[16px] text-ink-900" x-text="activeItem"></p>
      <p class="text-[13px] text-ink-400 mt-2 max-w-sm mx-auto">
        این بخش آماده اتصال به API واقعی است. محتوای «<span x-text="activeItem"></span>» از زیرمجموعه «<span x-text="activeGroupLabel"></span>» اینجا نمایش داده می‌شود.
      </p>
    </div>
  </div>
</template>
