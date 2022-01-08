<?php 
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template as Template;
$labelClass = config('myconf.template.form_label.class');
$inputClass = config('myconf.template.form_input.class');
$hiddenId=Form::hidden('id',$item['id']??'');
$listLevel =  ['default'=>'Select level','admin'=>config('myconf.template.level.admin.name'),'member'=>config('myconf.template.level.member.name')];
$hiddenTask=Form::hidden('task','change-level');
$elements=[
    [
        'label' => Form::label('level', 'Level', ['class' => $labelClass]),
        'element' =>Form::select('level', $listLevel, $item['level']??'default',['class'=>$inputClass])
    ],
    [
        'element' =>$hiddenId.$hiddenTask.Form::submit('Save',['class'=>'btn btn-success']),
        'type'=>'btn-submit'
    ]
];

$labelName= Form::label('username', 'Name', ['class' => $labelClass]);
$inputName= Form::text('username', $item['username']??'',['class' => $inputClass]);
?>

<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
        @include('admin.template.x_title',['title'=>'Form Change Password'])
        <div class="x_content">
            {!! Form::open([
                'url' => route("$controllerName/change-level"),
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
