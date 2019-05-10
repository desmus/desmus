<table class="table table-responsive" id="recentActivityCreates-table">
    <thead>
        <tr>
            <th>Datetime</th>
        <th>User Id</th>
        <th>Recent Activity Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($recentActivityCreates as $recentActivityCreate)
        <tr>
            <td>{!! $recentActivityCreate->datetime !!}</td>
            <td>{!! $recentActivityCreate->user_id !!}</td>
            <td>{!! $recentActivityCreate->recent_activity_id !!}</td>
            <td>
                {!! Form::open(['route' => ['recentActivityCreates.destroy', $recentActivityCreate->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('recentActivityCreates.show', [$recentActivityCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('recentActivityCreates.edit', [$recentActivityCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>