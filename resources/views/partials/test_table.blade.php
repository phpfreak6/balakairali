<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tr>
            <th>Title</th>
            <th>file</th>
        </tr>
        @foreach($test_format as $row)
        <tr>
            <td>{{ $row->title }}</td>
            <td>{{ $row->filename }}</td>
        </tr>
        @endforeach
    </table>

    {!! $test_format->links() !!}
</div>