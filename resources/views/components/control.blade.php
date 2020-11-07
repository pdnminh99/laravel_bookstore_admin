<div class="col-lg-6 col-5 text-right">
    @foreach($controls as $control)
        <a href="{{ $control['url'] }}" class="btn btn-sm btn-neutral">{{ $control['name'] }}</a>
    @endforeach
</div>
