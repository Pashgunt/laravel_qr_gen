@extends('layout')

@section('title', 'Funnel Edit field')

@section('content')
    Edit funnel field
    <form action="{{ route('funnel.update.field', ['field_id' => $data['field_data']['funnel_field_id']]) }}" method="POST"
        class="funnel__form">
        @csrf
        @method('PUT')
        <div>
            <label for="trigger">Триггеры</label>
            <div class="trigger__wrapper">
                <div class="trigger__content">
                    <div>
                        <label for="field">Field</label>
                        <select name="field" id="field" class="field">
                            <option value="">Выберите поле</option>
                            @foreach ($data['funnel_options'] as $funnelName => $funnelTag)
                                <option value="{{ $funnelTag }}" @selected($funnelTag == $data['field_data']['field_name'])>{{ $funnelName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="operator">Operator</label>
                        <select name="operator" id="operator" class="operator">
                            <option value="">Выберите тип воронки</option>
                            @foreach ($data['operators'] as $operator)
                                <option value="{{ $operator['tag'] }}" @selected($operator['tag'] === $data['field_data']['operator'])>
                                    <?= $operator['name'] ?></option>
                            @endforeach
                        </select>
                    </div>
                    <div class="range__warapper">
                        <label for="range">Range</label>
                        <input type="text" id="range" name="range" placeholder="from"
                            value="{{ $data['field_data']['value_range_from'] }}">
                        <input type="text" id="range_to" name="range_to" placeholder="to"
                            value="{{ $data['field_data']['value_range_to'] }}">
                    </div>
                    <div class="value__wrapper">
                        <label for="value">Value</label>
                        <input type="text" id="value" name="value" placeholder="value"
                            value="{{ $data['field_data']['value'] }}">
                    </div>
                </div>
            </div>
        </div>

        <button>Send</button>
    </form>
@endsection

@vite('resources/js/funnel.js')
