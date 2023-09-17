<h1 class="font-mono font-semibold tracking-wide text-center mb-2 text-2xl lg:text-3xl dark:text-gray-200">
    {{ $getCompanyName() }}
    @if ($isShowcompanyTable())
        (стол {{ $getTableNumber() }})
    @endif
</h1>
@if ($isShowCompanyAddress())
    <span class="font-extralight dark:text-gray-400">{{ $getCompanyAddress() }}</span>
@endif
