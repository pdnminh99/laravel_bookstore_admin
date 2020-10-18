<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
        <tr>
            @foreach($headers as $header)
                <th scope="col">{{ $header }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody class="list">
        @each('components.tabular.row', $records, 'row')
        </tbody>
    </table>
</div>
