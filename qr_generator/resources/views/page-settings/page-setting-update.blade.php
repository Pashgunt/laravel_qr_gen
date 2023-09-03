@extends('layout')

@section('title', 'Page setting create')

@section('content')
    <form action="{{ route('page-settings.update', ['page_setting' => $setting->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="page_type">page type</label>
            <select name="page_type" id="page_type">
                <option value="">select page type</option>
                @foreach ($pageTypes as $pageType)
                    <option value="{{ $pageType['tag'] }}" @selected($pageType['tag'] === $setting->page_type)>
                        {{ $pageType['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="company_id">Company</label>
            <select name="company_id" id="company_id">
                <option value="">select company</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" @selected($company->id === $setting->company_id)>{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="page_positive">
            Page positive feedback
            <div>
                <label for="title_positive">Title</label>
                <input type="text" name="title_positive" id="title_positive" placeholder="Title"
                    value="{{ $setting->title }}">
            </div>
            <div>
                <label for="text_positive">Text</label>
                <textarea name="text_positive" id="text_positive" cols="30" rows="10" placeholder="Text">{{ $setting->text }}</textarea>
            </div>
            @if ($setting->getPageSettingLinks()->first())
                @foreach ($setting->getPageSettingLinks()->get() as $link)
                    <div class="map_wrapper">
                        <label for="map_links">Map Setting</label>
                        <input type="text" id="map_links" name="map_links[]" placeholder="Map link"
                            value="{{ $link->link }}">
                        <input type="text" id="map_name" name="map_names[]" placeholder="Map name"
                            value="{{ $link->link_title }}">
                    </div>
                @endforeach
            @else
                <div class="map_wrapper">
                    <label for="map_links">Map Setting</label>
                    <input type="text" id="map_links" name="map_links[]" placeholder="Map link">
                    <input type="text" id="map_name" name="map_names[]" placeholder="Map name">
                </div>
            @endif
            <a href="#" class="add_map_link_wrapper">Add Map Link</a>
            <div>
                <label for="show_company_contact">Show company contacts</label>
                <input type="checkbox" name="show_company_contact" id="show_company_contact" @checked($setting->show_company_info)>
            </div>
        </div>
        <div class="page_negative">
            Page negative feedback
            <div>
                <label for="title_negative">Title</label>
                <input type="text" name="title_negative" id="title_negative" placeholder="Title"
                    value="{{ $setting->title }}">
            </div>
            <div>
                <label for="text_negative">Text</label>
                <textarea name="text_negative" id="text_negative" cols="30" rows="10" placeholder="Text">{{ $setting->text }}
                </textarea>
            </div>
            <div>
                <label for="show_company_contact">Show company contacts</label>
                <input type="checkbox" name="show_company_contact" id="show_company_contact" @checked($setting->show_company_info)>
            </div>
        </div>
        <button>update</button>
    </form>
@endsection

@section('js', '/assets/js/page-setting.js')
