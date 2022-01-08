@php 
use App\Helpers\Template;
use App\Helpers\Hightlight;

@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <th class="column-title">#</th>
                <th class="column-title">Username</th>
                <th class="column-title">Email</th>
                <th class="column-title">Fullname</th>
                <th class="column-title">Level</th>
                <th class="column-title">Avatar</th>
                <th class="column-title">Trạng thái</th>
                <th class="column-title">Tạo mới</th>
                <th class="column-title">Chỉnh sửa</th>
                <th class="column-title">Hoạt động</th>
            </tr>
            </thead>
            <tbody>
            @if (count($items) > 0)
                @foreach ($items as $key=>$val)
                    @php
                        $index= $key+1;
                        $id=$val['id'];
                        $username = $val['username'];
                        $email = $val['email'];
                        $fullname = $val['fullname'];
                        $level =Template::showItemSelect($controllerName,$id,$val['level'],'level');
                        $avatar = $val['avatar'];
                        $status= $val['status'];

                        $created= $val['created'];
                        $created_by= $val['created_by'];
                        $modified= $val['modified'];
                        $modified_by=$val['modified_by'];
                        
                        $actions = Template::showItemAction($controllerName,$id);
                        $createHistory = Template::showItemHistory($created_by,$created);
                        $modifiedHistory = Template::showItemHistory($modified_by,$modified);
                        $avatar=Template::showItemThumb($controllerName,$val['avatar'],$username);
                        $class = $index %2 ==0 ? 'even' :'odd';
                        $statusBtn = Template::showItemStatus($controllerName,$id,$status);
                    @endphp
                    <tr class="{{ $class }} pointer">
                        <td class="">{{ $index }}</td>
                        <td >
                           {{ $username }}
                        </td>
                        <td >{!! $email !!}</td>
                        <td >{!! $fullname !!}</td>
                        <td >{!! $level !!}</td>
                        <td width="5%">{!! $avatar !!}</td>
                        <td>{!! $statusBtn !!}</td>
                        <td>{!! $createHistory !!}</td>
                        <td>{!! $modifiedHistory !!}</td>
                        <td>{!! $actions !!}</td>
                        
                    </tr>
                @endforeach
            @else
                @include('admin.template.list_empty',['colspan'=>6])
            @endif
            </tbody>
        </table>
    </div>
</div>