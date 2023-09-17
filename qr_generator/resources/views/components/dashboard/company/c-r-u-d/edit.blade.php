<form action="{{ route('company.update', ['company_id' => $company->id]) }}" method="POST"
    class="py-12 px-5 flex flex-col gap-4">
    @csrf
    @method('put')

    <div class="flex flex-col gap-4">
        <div>
            <x-forms.fields.input label='Название заведения' show-error='1' name='name' show-error-message='1'
                placeholder='Название заведения' require-mark='1' default-value="{{ $company->name }}" />
        </div>
        <div>
            <x-forms.fields.input label='Адресс' show-error='1' name='adress' show-error-message='1'
                placeholder='Адресс' require-mark='1' default-value="{{ $company->adress }}"/>
        </div>
        <div>
            <x-forms.fields.input label='Ссылка на сайт' show-error='1' name='link' show-error-message='1'
                placeholder='Ссылка на сайт' default-value="{{ $company->link }}"/>
        </div>
    </div>

    <button
        class="text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mt-5 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-white dark:hover:bg-yellow-400 dark:focus:ring-yellow-900">Обновить</button>
</form>
