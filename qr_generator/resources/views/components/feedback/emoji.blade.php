<div class="mb-5 mx-auto">
    <div class="flex justify-center align-items-center gap-5 lg:gap-8">
        <label class="location-form__radio radio" for="angry">
            <input class="radio__input hidden" id="angry" type="radio" name="{{ $name }}"
                @checked($isChecked(old('rating'), '1')) value="1">
            <span
                class="block w-9 h-9 lg:w-11 lg:h-11 xl:w-14 xl:h-14 bg-[url(/public/img/smiles/angry.png)] bg-center bg-contain {{ $isActive(old('rating'), '1') }} hover:opacity-100 hover:cursor-pointer transition-opacity"></span>
        </label>
        <label class="location-form__radio radio" for="sad">
            <input class="radio__input hidden" id="sad" type="radio" name="{{ $name }}"
                @checked($isChecked(old('rating'), '2')) value="2">
            <span
                class="block w-9 h-9 lg:w-11 lg:h-11 xl:w-14 xl:h-14 bg-[url(/public/img/smiles/sad.png)] bg-center bg-contain {{ $isActive(old('rating'), '2') }} hover:opacity-100 hover:cursor-pointer transition-opacity"></span>
        </label>

        <label class="location-form__radio radio" for="neutral">
            <input class="radio__input hidden" id="neutral" type="radio" name="{{ $name }}"
                @checked($isChecked(old('rating'), '3')) value="3">
            <span
                class="block w-9 h-9 lg:w-11 lg:h-11 xl:w-14 xl:h-14 bg-[url(/public/img/smiles/neutral.png)] bg-center bg-contain {{ $isActive(old('rating'), '3') }} hover:opacity-100 hover:cursor-pointer transition-opacity"></span>
        </label>

        <label class="location-form__radio radio" for="positive">
            <input class="radio__input hidden" id="positive" type="radio" name="{{ $name }}"
                @checked($isChecked(old('rating'), '4')) value="4">
            <span
                class="block w-9 h-9 lg:w-11 lg:h-11 xl:w-14 xl:h-14 bg-[url(/public/img/smiles/positive.png)] bg-center bg-contain {{ $isActive(old('rating'), '4') }} hover:opacity-100 hover:cursor-pointer transition-opacity"></span>
        </label>

        <label class="location-form__radio radio" for="happy">
            <input class="radio__input hidden" id="happy" type="radio" name="{{ $name }}"
                @checked($isChecked(old('rating'), '5')) value="5">
            <span
                class="block w-9 h-9 lg:w-11 lg:h-11 xl:w-14 xl:h-14 bg-[url(/public/img/smiles/happy.png)] bg-center bg-contain {{ $isActive(old('rating'), '5') }} hover:opacity-100 hover:cursor-pointer transition-opacity"></span>
        </label>
    </div>
</div>
@if ($isShowError())
    @error($name)
        <p class="my-2 text-sm text-red-600 text-center">
            <span class="font-medium">{{ $message }}</span>
        </p>
    @enderror
@endif
