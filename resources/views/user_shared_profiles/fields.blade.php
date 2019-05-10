<div class="form-group col-sm-12">
  {!! Form::label('permissions', 'Permissions:') !!}
  {!! Form::select('permissions', array('basic' => 'Read', 'advanced' => 'Update'), $userSharedProfile[0] -> permissions, ['class' => 'form-control']) !!}
</div>

{!! Form::hidden('datetime', 'Datetime:') !!}
{!! Form::hidden('datetime', $userSharedProfile[0] -> datetime, ['class' => 'form-control']) !!}

{!! Form::hidden('description', 'Description:') !!}
{!! Form::hidden('description', $userSharedProfile[0] -> description, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $userSharedProfile[0] -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('user_id', 'User Id:') !!}
{!! Form::hidden('user_id', $userSharedProfile[0] -> user_id, ['class' => 'form-control']) !!}

{!! Form::hidden('shared_user_id', 'Shared Profile Id:') !!}
{!! Form::hidden('shared_user_id', $userSharedProfile[0] -> shared_user_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('userSharedProfiles.show', [$userSharedProfile[0] -> user_id]) !!}" class="btn btn-default">Cancel</a>
</div>