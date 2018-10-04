@extends('templates.frontend.layout')

@section('seo-title')
    <title>{{ $page->title }} {{ config('app.seo-separator') }} {{ config('app.name') }}</title>
@endsection

@section('page-title')
    {{ $page->title }}
@endsection

@section('custom-css')
@endsection

@section('content')
    
    <div class="c-content-blog-post-1-view">
        <div class="c-content-blog-post-1">
            @if(!empty($page->image))
            <div class="c-media">
                <div class="c-content-media-2-slider" data-slider="owl">
                    <div class="owl-theme c-theme owl-single" data-single-item="true" data-auto-play="4000" data-rtl="false">
                        <div class="item text-center">        
                            <img src="{{ $page->getImage('xl') }}">
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
            <div class="c-title c-font-bold c-font-uppercase">
                <a href="#">{{ $page->title }}</a>
            </div>
            
            <div class="c-desc">
                {!! $page->content !!}
            </div>
            
        </div>
    </div>
                        
@endsection

@section('custom-js')
@endsection
