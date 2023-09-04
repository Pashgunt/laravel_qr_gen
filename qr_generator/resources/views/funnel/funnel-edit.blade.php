@extends('layout')

@section('title', 'Funnel Edit')

@section('content')
    Edit funnel
    <form action="{{ route('funnel.update', ['funnel_id' => current($data['funnel_data'])['funnel_config_id']]) }}"
        method="POST" class="funnel__form">
        @csrf
        @method('PUT')
        <div>
            <label for="company_id">Company</label>
            <select name="company_id" id="company_id">
                <option value="">Select company</option>
                @foreach ($data['companies'] as $company)
                    <option value="{{ $company->id }}" @selected(current($data['funnel_data'])['company_id'] == $company->id)>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="funnel_type">Тип воронки</label>
            <select name="funnel_type" id="funnel_type">
                <option value="">Выберите тип воронки</option>
                @foreach ($data['funnel']['funnel_options'] as $funnelOption)
                    <option value="{{ $funnelOption['id'] }}" @selected(current($data['funnel_data'])['funnel_type_tag'] == $funnelOption['funnel_type_tag'])>
                        <?= $funnelOption['funnel_type_name'] ?></option>
                @endforeach
            </select>
        </div>

        @foreach ($data['funnel_data'] as $funnelData)
            <div>
                <label for="trigger">Триггеры</label>
                <div class="trigger__wrapper">
                    <div class="trigger__content">
                        <div>
                            <label for="field">Field</label>
                            <select name="field[]" id="field" class="field"
                                data-field-tag="{{ $funnelData['field_name'] ?? '' }}">
                                <option value="">Выберите поле</option>
                            </select>
                        </div>
                        <div>
                            <label for="operator">Operator</label>
                            <select name="operator[]" id="operator" class="operator">
                                <option value="">Выберите тип воронки</option>
                                @foreach ($data['funnel']['operators'] as $operator)
                                    <option value="{{ $operator['tag'] }}" @selected($operator['tag'] === $funnelData['operator'])>
                                        <?= $operator['name'] ?></option>
                                @endforeach
                            </select>
                        </div>
                        <div class="range__warapper">
                            <label for="range">Range</label>
                            <input type="text" id="range" name="range[]" placeholder="from"
                                value="{{ $funnelData['value_range_from'] }}">
                            <input type="text" id="range_to" name="range_to[]" placeholder="to"
                                value="{{ $funnelData['value_range_to'] }}">
                        </div>
                        <div class="value__wrapper">
                            <label for="value">Value</label>
                            <input type="text" id="value" name="value[]" placeholder="value"
                                value="{{ $funnelData['value'] }}">
                        </div>
                        <div class="logic__wrapper">
                            <label for="logic">И / ИЛИ</label>
                            <select name="logic[]" id="logic">
                                <option value="">И / ИЛИ</option>
                                @foreach ($data['funnel']['logic'] as $logic)
                                    <option value="{{ $logic['operator'] }}" @selected(!empty($funnelData['logic_operator']) && $logic['operator'] === $funnelData['logic_operator'])>
                                        {{ $logic['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div>
            <label for="work_start">Отслеживать с </label>
            <input type="date" name="work_start" id="work_start"
                value="{{ current($data['funnel_data'])['work_started_at'] }}">
        </div>

        <button>Send</button>
    </form>
@endsection

@section('js', 'resources/js/funnel.js')
