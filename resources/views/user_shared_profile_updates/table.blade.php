<table class="table table-responsive" id="userSharedProfileUpdates-table">
    <thead>
        <tr>
            <th>Datetime</th>
        <th>User Id</th>
        <th>User Shared Profile Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($userSharedProfileUpdates as $userSharedProfileUpdate)
        <tr>
            <td>{!! $userSharedProfileUpdate->datetime !!}</td>
            <td>{!! $userSharedProfileUpdate->user_id !!}</td>
            <td>{!! $userSharedProfileUpdate->user_shared_profile_id !!}</td>
            <td>
                {!! Form::open(['route' => ['userSharedProfileUpdates.destroy', $userSharedProfileUpdate->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('userSharedProfileUpdates.show', [$userSharedProfileUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('userSharedProfileUpdates.edit', [$userSharedProfileUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>