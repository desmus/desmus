<table class="table table-responsive" id="userCollegeTSTools-table">
    <thead>
        <tr>
            <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>College T S Tool Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($userCollegeTSTools as $userCollegeTSTool)
        <tr>
            <td>{!! $userCollegeTSTool->datetime !!}</td>
            <td>{!! $userCollegeTSTool->description !!}</td>
            <td>{!! $userCollegeTSTool->status !!}</td>
            <td>{!! $userCollegeTSTool->permissions !!}</td>
            <td>{!! $userCollegeTSTool->user_id !!}</td>
            <td>{!! $userCollegeTSTool->college_t_s_tool_id !!}</td>
            <td>
                {!! Form::open(['route' => ['userCollegeTSTools.destroy', $userCollegeTSTool->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('userCollegeTSTools.show', [$userCollegeTSTool->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('userCollegeTSTools.edit', [$userCollegeTSTool->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>