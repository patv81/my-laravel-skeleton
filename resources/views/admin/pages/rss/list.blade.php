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
                <th class="column-title">Link</th>
                <th class="column-title">Source</th>
                <th class="column-title">Ordering</th>
                <th class="column-title">Status</th>
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
                        $status= $val['status'];
                        $link = $val['link'];
                        $ordering = $val['ordering'];
                        $source= $val['source'];
                        
                        
                        $actions = Template::showItemAction($controllerName,$id);
                        
                        
                        
                        $class = $index %2 ==0 ? 'even' :'odd';
                        $statusBtn = Template::showItemStatus($controllerName,$id,$status);
                    @endphp
                    <tr class="{{ $class }} pointer">
                        <td class="">{{ $index }}</td>
                        <td>
                             {{ $name }}
                        </td>
                        <td>
                            {!! $link !!}
                        </td>
                        <td>
                            {!! $source !!}
                        </td>
                        <td>
                            {!! $ordering !!}
                        </td>
                        <td>
                            {!! $statusBtn !!}
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