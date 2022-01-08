<?php 
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template as Template;
$labelClass = config('myconf.template.form_label.class');
$inputClass = config('myconf.template.form_input.class');
$listStatus = ['default'=>'Select status','active'=>config('myconf.template.status.active.name'),'inactive'=>config('myconf.template.status.inactive.name')];
$listLevel =  ['default'=>'Select level','admin'=>config('myconf.template.level.admin.name'),'member'=>config('myconf.template.level.member.name')];
$hiddenId=Form::hidden('id',$item['id']??'');
$hiddenThumb=Form::hidden('avatar_current',$item['avatar']??'');
$hiddenTask=Form::hidden('task','edit-info');
$elements=[
    [
        'label' => Form::label('username', 'Username', ['class' => $labelClass]),
        'element' =>Form::text('username', $item['username']??'',['class' => $inputClass])
    ],
    [
        'label' => Form::label('email', 'Email', ['class' => $labelClass]),
        'element' =>Form::text('email', $item['email']??'',['class' => $inputClass])
    ],
    [
        'label' => Form::label('fullname', 'Fullname', ['class' => $labelClass]),
        'element' =>Form::text('fullname', $item['fullname']??'',['class' => $inputClass])
    ],
    [
        'label' => Form::label('status', 'Status', ['class' => $labelClass]),
        'element' =>Form::select('status', $listStatus, $item['status']??'default',['class'=>$inputClass])
    ],
    [
        'label' => Form::label('avatar', 'Avatar', ['class' => $labelClass]),
        'element' =>Form::file('avatar',['class'=>$inputClass]),
        'avatar'=>(!empty($item['id'])) ? Template::showItemThumb($controllerName, $item['avatar'],$item['username']) : null ,
        'type'=> 'avatar'
    ],
    [
        'element' =>$hiddenId.$hiddenThumb.$hiddenTask.Form::submit('Save',['class'=>'btn btn-success']),
        'type'=>'btn-submit'
    ]
];

$labelName= Form::label('username', 'Name', ['class' => $labelClass]);
$inputName= Form::text('username', $item['username']??'',['class' => $inputClass]);
?>

<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
        @include('admin.template.x_title',['title'=>'Form Edit Info'])
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
