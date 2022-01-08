<?php 
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template as Template;
$labelClass = config('myconf.template.form_label.class');
$inputClass = config('myconf.template.form_input.class');
$hiddenId=Form::hidden('id',$item['id']??'');

$hiddenTask=Form::hidden('task','change-password');
$elements=[
    [
        'label' => Form::label('password', 'Password', ['class' => $labelClass]),
        'element' =>Form::password('password', ['class' => $inputClass])
    ],
    [
        'label' => Form::label('password_confirmation', 'Password Confirmation', ['class' => $labelClass]),
        'element' =>Form::password('password_confirmation', ['class' => $inputClass])
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
                'url' => route("$controllerName/change-password"),
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
