
@extends('admin.main')


<?php 
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template as Template;
$labelClass = config('myconf.template.form_label.class');
$inputClass = config('myconf.template.form_input.class');
$listStatus = ['default'=>'Select status','active'=>config('myconf.template.status.active.name'),'inactive'=>config('myconf.template.status.inactive.name')];
$sourceConfig= config('myconf.template.rss_source');
$listSource = array_combine(array_keys($sourceConfig),array_column($sourceConfig,'name'));

$hiddenId=Form::hidden('id',$item['id']??'');
$hiddenThumb=Form::hidden('thumb_current',$item['thumb']??'');
$elements=[
    [
        'label' => Form::label('name', 'Name', ['class' => $labelClass]),
        'element' =>Form::text('name', $item['name']??'',['class' => $inputClass])
    ],
    [
        'label' => Form::label('link', 'Link', ['class' => $labelClass]),
        'element' =>Form::text('link', $item['link']??'',['class'=>$inputClass])
    ],
    [
        'label' => Form::label('source', 'Source', ['class' => $labelClass]),
        'element' =>Form::select('source',$listSource, $item['source']??'',['class' => $inputClass])
    ],
    [
        'label' => Form::label('ordering', 'Ordering', ['class' => $labelClass]),
        'element' =>Form::number('ordering', $item['ordering']??'',['class' => $inputClass])
    ],
    [
        'label' => Form::label('status', 'Status', ['class' => $labelClass]),
        'element' =>Form::select('status', $listStatus, $item['status']??'default',['class'=>$inputClass])
    ],
    [
        'element' =>$hiddenId.Form::submit('Save',['class'=>'btn btn-success']),
        'type'=>'btn-submit'
    ]
];

$labelName= Form::label('name', 'Name', ['class' => $labelClass]);
$inputName= Form::text('name', $item['name']??'',['class' => $inputClass]);
?>
@section('content')
    @include('admin.template.page_header',['pageIndex'=>false])
    @include('admin.template.error')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.template.x_title',['title'=>'Form'])
                <div class="x_content">
                    {!! Form::open([
                        'url' => route("$controllerName/save"),
                        'method'=>'POST',
                        'enctype'=>'multipart/form-data',
                        'class'=>'form-horizontal form-label-left',
                        'id'=>'main_form',
                        'accept-charset'=>'UTF-8']) !!}
                        {!! FormTemplate::show($elements) !!}
                        
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@endsection