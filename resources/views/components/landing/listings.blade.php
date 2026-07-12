<section id="listings" class="max-w-[1180px] mx-auto px-5 py-20">
    <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between mb-10">
        <div>
            <p class="text-[13px] font-semibold text-teal-600">آگهی‌های اخیر</p>
            <h2 class="text-[24px] sm:text-[28px] font-extrabold text-ink-900">امتیازهای وام با بهترین شرایط</h2>
        </div>
        <a href="/ads/loadLoans" class="inline-flex items-center justify-center rounded-full border border-gray-200 px-4 py-2 text-[13px] font-semibold text-ink-700 hover:border-teal-500 hover:text-teal-600 transition-colors">
            مشاهده همه آگهی‌ها
        </a>
    </div>

    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
        @php
            $items = [
                ['title' => 'وام مسکن - بانک ملت', 'plan' => 'طرح رفاه ملت', 'score' => '۸۵۰ امتیاز', 'price' => '۱۲۰,۰۰۰,۰۰۰ تومان', 'city' => 'تهران', 'color' => 'bg-red-400'],
                ['title' => 'وام خودرو - بانک صادرات', 'plan' => 'طرح صادرات کارت', 'score' => '۷۲۰ امتیاز', 'price' => '۸۵,۰۰۰,۰۰۰ تومان', 'city' => 'اصفهان', 'color' => 'bg-blue-400'],
                ['title' => 'وام شخصی - بانک ملی', 'plan' => 'طرح مهربانی', 'score' => '۸۱۰ امتیاز', 'price' => '۶۵,۰۰۰,۰۰۰ تومان', 'city' => 'شیراز', 'color' => 'bg-emerald-500'],
            ];
        @endphp

        @foreach ($items as $item)
            <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <div class="flex items-center justify-between">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl text-sm font-bold text-white {{ $item['color'] }}">
                        {{ Str::limit($item['title'], 1, '') }}
                    </div>
                    <span class="rounded-full bg-teal-50 px-2.5 py-1 text-[11px] font-bold text-teal-700">پیشنهاد ویژه</span>
                </div>

                <h3 class="mt-4 text-[15px] font-extrabold text-ink-900">{{ $item['title'] }}</h3>
                <p class="mt-1 text-[12.5px] text-ink-500">{{ $item['plan'] }}</p>

                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="rounded-full bg-gray-50 px-2.5 py-1 text-[11px] font-bold text-ink-600">{{ $item['score'] }}</span>
                    <span class="rounded-full bg-gray-50 px-2.5 py-1 text-[11px] font-bold text-ink-600">{{ $item['city'] }}</span>
                </div>

                <p class="mt-4 text-[15px] font-extrabold text-ink-900">{{ $item['price'] }}</p>

                <a href="/ads/loadLoans" class="mt-4 inline-flex w-full items-center justify-center rounded-xl border border-gray-200 py-2.5 text-[13px] font-semibold text-ink-700 transition hover:border-teal-500 hover:text-teal-700">
                    مشاهده جزئیات
                </a>
            </div>
        @endforeach
    </div>
</section>
