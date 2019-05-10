<table class="table table-responsive" id="userSharedProfileDeletes-table">
    <thead>
        <tr>
            <th>Datetime</th>
        <th>User Id</th>
        <th>User Shared Profile Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($userSharedProfileDeletes as $userSharedProfileDelete)
        <tr>
            <td>{!! $userSharedProfileDelete->datetime !!}</td>
            <td>{!! $userSharedProfileDelete->user_id !!}</td>
            <td>{!! $userSharedProfileDelete->user_shared_profile_id !!}</td>
            <td>
                {!! Form::open(['route' => ['userSharedProfileDeletes.destroy', $userSharedProfileDelete->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('userSharedProfileDeletes.show', [$userSharedProfileDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('userSharedProfileDeletes.edit', [$userSharedProfileDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>