<div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12 dark:bg-gray-900">
    <img src="{{ URL('img/beams.png') }}" alt=""
        class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" width="1308" />
    <div
        class="absolute bg-[url(/public/img/grid.svg)] inset-0 bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]">
    </div>
    <x-specilas.background />
    {{ $slot }}
</div>
