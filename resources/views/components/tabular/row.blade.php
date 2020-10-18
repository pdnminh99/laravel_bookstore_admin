<tr>
    @foreach($row->get_fields() as $field)
        @switch($field->type)
            @case(\App\View\Models\FieldType::TEXT_W_THUMBNAIL)
            <th scope="row">
                <div class="media align-items-center">
                    @if(isset($field->route))
                        <a href="{{ $field->route }}" class="avatar rounded-circle mr-3">
                            <img alt="{{ $field->content }}" src="{{ asset($field->thumbnail) }}">
                        </a>
                    @else
                        <img alt="{{ $field->content }}" src="{{ asset($field->thumbnail) }}">
                    @endif

                    <div class="media-body">
                        <span class="name mb-0 text-sm">{{ $field->content }}</span>
                    </div>
                </div>
            </th>
            @break
            @case(\App\View\Models\FieldType::TEXT)
            <td class="budget">
                {{ $field->content ?? 'undefined' }}
            </td>
            @break
            @case(\App\View\Models\FieldType::STATUS)
            <td>
                <x-tabular-status :message="$field->content" :status="$field->status"></x-tabular-status>
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
    {{--    <td class="text-right">--}}
    {{--        @include('components.tabular.action', $row->get_actions())--}}
    {{--    </td>--}}
</tr>
