@php 
use App\Helpers\Template;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <th class="column-title">#</th>
                <th class="column-title">Slider Info</th>
                <th class="column-title">Trạng Thái</th>
                <th class="column-title">Tạo mới</th>
                <th class="column-title">Chỉnh sửa</th>
                <th class="column-title">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @if (count($items) > 0)
                @foreach ($items as $key=>$val)
                    @php
                        $index= $key+1;
                        $id=$val['id'];
                        $name =$val['name'];
                        $email = $val['email'];
                        $description = $val['description'];
                        $link= $val['link'];
                        
                        $created= $val['created'];
                        $created_by= $val['created_by'];
                        $modified= $val['modified'];
                        $modified_by=$val['modified_by'];
                        $status= $val['status'];
                        
                        $actions = Template::showItemAction($controllerName,$id);
                        $createHistory = Template::showItemHistory($created_by,$created);
                        $modifiedHistory = Template::showItemHistory($modified_by,$modified);
                        $thumb=Template::showItemThumb($controllerName,$val['thumb'],$name);
                        $class = $index %2 ==0 ? 'even' :'odd';
                        $statusBtn = Template::showItemStatus($controllerName,$id,$status);
                    @endphp
                    <tr class="{{ $class }} pointer">
                        <td class="">{{ $index }}</td>
                        <td width="40%">
                            <p><strong>Name:</strong> {{ $name }}</p>
                            <p><strong>Description:</strong>{{ $description }}</p>
                            <p><strong>Link:</strong>{{ $link }}</p>
                            {!! $thumb !!}
                        </td>
                        <td>
                            {!! $statusBtn !!}
                        </td>
                        <td>
                            {!! $createHistory !!}
                        </td>
                        <td>
                            {!! $modifiedHistory !!}
                        </td>
                        <td class="last">
                            
                            {!! $actions !!}
                        </td>
                    </tr>
                @endforeach
            @else
                @include('admin.template.list_empty',['colspan'=>6])
            @endif
            </tbody>
        </table>
    </div>
</div>