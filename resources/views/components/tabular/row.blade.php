<tr>
    @foreach($row->get_fields() as $field)
        @switch($field->type)
            @case(\App\View\Models\FieldType::TEXT)
            @isset($field->thumbnail)
                @if($loop->first)
                    <th scope="row">
                        @include('components.tabular.text-with-thumbnail-field', ['thumbnail' => $field->thumbnail, 'route' => $field->route, 'content' => $field->content])
                    </th>
                @else
                    <td>
                        @include('components.tabular.text-with-thumbnail-field', ['thumbnail' => $field->thumbnail, 'route' => $field->route, 'content' => $field->content])
                    </td>
                @endif
            @else
                @if($loop->first)
                    <th scope="row">
                        {{ $field->content ?? '' }}
                    </th>
                @else
                    <td>
                        {{ $field->content ?? '' }}
                    </td>
                @endif
            @endif
            @break
            @case(\App\View\Models\FieldType::STATUS)
            @if($loop->first)
                <th scope="row">
                    <x-tabular-status :message="$field->content" :status="$field->status"></x-tabular-status>
                </th>
            @else
                <td>
                    <x-tabular-status :message="$field->content" :status="$field->status"></x-tabular-status>
                </td>
            @endif
            @break
            @case(\App\View\Models\FieldType::ACTIONS)
            <td>
                @include('components.tabular.action', ['actions'=>$field->actions])
            </td>
            @break
        @endswitch
    @endforeach
    {{--    <td>--}}
    {{--        @include('components.tabular.avatar-group')--}}
    {{--    </td>--}}
    {{--    <td>--}}
    {{--        @include('components.tabular.progress')--}}
    {{--    </td>--}}
</tr>
