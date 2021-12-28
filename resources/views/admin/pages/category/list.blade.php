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
                <th class="column-title">Name</th>
                <th class="column-title">Trạng Thái</th>
                <th class="column-title">Hiển Thị Home</th>
                <th class="column-title">Kiểu hiển thị </th>
                <th class="column-title">Tạo mới</th>
                <th class="column-title">Chỉnh sửa</th>
                <th class="column-title">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @if (count($items) > 0)
                @foreach ($items as $key=>$val)
                    @php
                        $id=$val['id'];
                        $index= $key+1;
                        $name = $val['name'];
                        $statusBtn = Template::showItemStatus($controllerName,$id,$val['status']);
                        $isHomeBtn = Template::showItemIsHome($controllerName,$id,$val['is_home']);
                        $display = Template::showItemSelect($controllerName,$id,$val['display']);
                        $createHistory = Template::showItemHistory($val['created_by'],$val['created']);
                        $modifiedHistory = Template::showItemHistory($val['modified_by'],$val['modified']);
                        $actions = Template::showItemAction($controllerName,$id);
                        $class = $index %2 ==0 ? 'even' :'odd';
                    @endphp
                    <tr class="{{ $class }} pointer">
                        <td class="">{{ $index }}</td>
                        <td width="20%">
                            {{ $name }}
                        </td>
                        <td>{!! $statusBtn !!}</td>
                        <td>{!! $isHomeBtn !!}</td>
                        <td>{!! $display !!}</td>
                        <td>{!! $createHistory !!}</td>
                        <td>{!! $modifiedHistory !!}</td>
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