
@extends('admin.main')

@section('content')
    @include('admin.template.page_header',['pageIndex'=>false])
    @include('admin.template.error')
    @if (!empty($item['id']))
        <div class="row">
            @include('admin.pages.user.form_info')
            @include('admin.pages.user.form_change_password')
            @include('admin.pages.user.form_change_level')
        </div>
    @else
        @include('admin.pages.user.form_add')
    @endif
@endsection