@extends('layout')

@section('title', 'Funnel Settings')

@section('content')
    Настройка воронки
    <form action="{{ route('funnel.store') }}" method="POST" class="funnel__form">
        @csrf
        <div>
            <label for="funnel_type">Тип воронки</label>
            <select name="funnel_type" id="funnel_type">
                <option value="">Выберите тип воронки</option>
                @foreach ($funnel['funnel_options'] as $funnelOption)
                    <option value="{{ $funnelOption['id'] }}"><?= $funnelOption['funnel_type_name'] ?></option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="trigger">Триггеры</label>
            <div class="trigger__wrapper">
                <div class="trigger__content">
                    <div>
                        <label for="field">Field</label>
                        <select name="field[]" id="field" class="field">
                            <option value="">Выберите поле</option>
                        </select>
                    </div>
                    <div>
                        <label for="operator">Operator</label>
                        <select name="operator[]" id="operator">
                            <option value="">Выберите тип воронки</option>
                            @foreach ($funnel['operators'] as $operator)
                                <option value="{{ $operator['tag'] }}"><?= $operator['name'] ?></option>
                            @endforeach
                        </select>
                    </div>
                    <div class="value__wrapper">
                        <label for="value">Value</label>
                        <input type="text" id="value" name="value[]" placeholder="value">
                    </div>
                    <div class="range__warapper">
                        <label for="range">Range</label>
                        <input type="text" id="range" name="range[]" placeholder="from">
                        <input type="text" id="range_to" name="range_to[]" placeholder="to">
                    </div>
                    <div class="logic__wrapper">
                        <label for="logic">И / ИЛИ</label>
                        <select name="logic[]" id="logic">
                            <option value="">И / ИЛИ</option>
                            @foreach ($funnel['logic'] as $logic)
                                <option value="{{ $logic['operator'] }}">{{ $logic['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <label for="work_start">Отслеживать с </label>
            <input type="date" name="work_start" id="work_start">
        </div>

        <button>Send</button>
    </form>
@endsection

@section('js', '/assets/js/funnel.js')
