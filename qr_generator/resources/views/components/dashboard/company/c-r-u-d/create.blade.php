<form action="{{ route('qr.store') }}" method="POST" class="py-12 px-5 flex flex-col gap-4 company_create">
    @csrf

    <div>
        <div class="mb-3">
            <x-forms.fields.checkbox label='Выбрать существующую организацию' show-error='1' name='create_new_company'
                show-error-message='0' outer-value="{{ app('request')->get('company_id') ? '1' : '0' }}" />
        </div>
        <div class="hidden">
            <x-forms.fields.select label='Организации' show-error='1' name='company_id' show-error-message='1'
                placeholder='Организации' require-mark='1' :companies="$companies"
                default-option='Выберите организацию из списка' />
        </div>
    </div>

    <div class="new_company_wrapper flex flex-col gap-4">
        <div>
            <x-forms.fields.input label='Название заведения' show-error='1' name='name' show-error-message='1'
                placeholder='Название заведения' require-mark='0' />
        </div>
        <div>
            <x-forms.fields.input label='Адресс' show-error='1' name='adress' show-error-message='1'
                placeholder='Адресс' require-mark='0' />
        </div>
        <div>
            <x-forms.fields.input label='Ссылка на сайт' show-error='1' name='link' show-error-message='1'
                placeholder='Ссылка на сайт' />
        </div>
    </div>

    <div>
        <div class="mb-3">
            <x-forms.fields.checkbox label='Нужна разметка по посадочным местам' show-error='1' name='places_sit_areas'
                show-error-message='0' />
        </div>
        <div class="hidden flex gap-3 justify-between places_sit_areas_wrapper">
            <x-forms.fields.input label='От' show-error='1' name='place_sit_from' show-error-message='1'
                placeholder='От' require-mark='0' />
            <x-forms.fields.input label='До' show-error='1' name='place_sit_to' show-error-message='1'
                placeholder='До' require-mark='0' />
        </div>
    </div>

    <div>
        <div class="mb-3">
            <x-forms.fields.checkbox label='Указать номера столов' show-error='1' name='place_sit_numbers'
                show-error-message='0' />
        </div>

        <div class="hidden place_sit_numbers_wrapper">
            <x-forms.fields.input label='Номер стола' show-error='1' name='place_sit_number[]' show-error-message='1'
                placeholder='Номер стола' require-mark='0' copy-buttons='1' />
        </div>
    </div>

    <button
        class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mt-5 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Создать</button>
</form>
