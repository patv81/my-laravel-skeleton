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
                <th class="column-title">Article Info</th>
                <th class="column-title">Danh mục</th>
                <th class="column-title">Kiểu bài viết</th>
                <th class="column-title">Trạng Thái</th>
                <th class="column-title">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @if (count($items) > 0)
                @foreach ($items as $key=>$val)
                    @php
                        $index= $key+1;
                        $id=$val['id'];
                        $name = $val['name'];
                        $email = $val['email'];
                        $created= $val['created'];
                        $created_by= $val['created_by'];
                        $modified= $val['modified'];
                        $modified_by=$val['modified_by'];
                        $status= $val['status'];
                        $content = $val['content'];
                        $category_name = $val['category_name'];
                        $actions = Template::showItemAction($controllerName,$id);
                        $thumb=Template::showItemThumb($controllerName,$val['thumb'],$name);
                        $class = $index %2 ==0 ? 'even' :'odd';
                        $statusBtn = Template::showItemStatus($controllerName,$id,$status);
                        $type = Template::showItemSelect($controllerName,$id,$val['type'],'type');
                    @endphp
                    <tr class="{{ $class }} pointer">
                        <td class="">{{ $index }}</td>
                        <td width="40%">
                            <p><strong>Name:</strong> {{ $name }}</p>
                            <p><strong>Content:</strong>{!! $content !!}</p>
                            {!! $thumb !!}
                        </td>
                        <td>{!! $category_name !!}</td>
                        <td>{!! $type !!}</td>
                        <td>{!! $statusBtn !!}</td>
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