@extends('layout')

@section('title', 'Page setting create')

@section('content')
    <form action="{{ route('page-settings.store') }}" method="POST">
        @csrf
        <div>
            <label for="page_type">page type</label>
            <select name="page_type" id="page_type">
                <option value="">select page type</option>
                @foreach ($pageTypes as $pageType)
                    <option value="{{ $pageType['tag'] }}">{{ $pageType['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="company_id">Company</label>
            <select name="company_id" id="company_id">
                <option value="">select company</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="page_positive">
            Page positive feedback
            <div>
                <label for="title_positive">Title</label>
                <input type="text" name="title_positive" id="title_positive" placeholder="Title">
            </div>
            <div>
                <label for="text_positive">Text</label>
                <textarea name="text_positive" id="text_positive" cols="30" rows="10" placeholder="Text"></textarea>
            </div>
            <div class="map_wrapper">
                <label for="map_links">Map Setting</label>
                <input type="text" id="map_links" name="map_links[]" placeholder="Map link">
                <input type="text" id="map_name" name="map_names[]" placeholder="Map name">
            </div>
            <a href="#" class="add_map_link_wrapper">Add Map Link</a>
            <div>
                <label for="show_company_contact">Show company contacts</label>
                <input type="checkbox" name="show_company_contact" id="show_company_contact">
            </div>
        </div>
        <div class="page_negative">
            Page negative feedback
            <div>
                <label for="title_negative">Title</label>
                <input type="text" name="title_negative" id="title_negative" placeholder="Title">
            </div>
            <div>
                <label for="text_negative">Text</label>
                <textarea name="text_negative" id="text_negative" cols="30" rows="10" placeholder="Text"></textarea>
            </div>
            <div>
                <label for="show_company_contact">Show company contacts</label>
                <input type="checkbox" name="show_company_contact" id="show_company_contact">
            </div>
        </div>
        <button>create</button>
    </form>
@endsection

@vite('resources/js/page-setting.js')
