@extends('layout')

@section('title', 'Page settings')

@section('content')
    <a href="{{ route('page-settings.create') }}">Create New Page Setting</a>

    @foreach ($settings as $setting)
        <div>
            {{ $setting->title }}
            {{ $setting->text }}
            {{ $setting->page_type }}
            {{ $setting->name }}
            <form action="{{ route('page-settings.destroy', ['page_setting' => $setting->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button>delete setting</button>
            </form>
            <a href="{{ route('page-settings.edit', ['page_setting' => $setting->id]) }}">edit setting</a>
            @foreach ($setting->getPageSettingLinks()->get() as $link)
                <hr>
                <div>
                    {{ $link->link }}
                    {{ $link->link_title }}
                    <form action="{{ route('page-settings.destroyLink', ['link_id' => $link->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>delete setting link</button>
                    </form>
                    <a href="{{ route('page-settings.updateLink', ['link_id' => $link->id]) }}">edit link</a>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection
