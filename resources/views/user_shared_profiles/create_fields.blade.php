<div class="form-group col-sm-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', 'Add a description ...', ['class' => 'form-control'], array('required' => 'required', 'id' => 'description')) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::label('shared_user_id', 'Shared User Id:') !!}
  {!! Form::select('shared_user_id', $select, null, ['class'=>'form-control'], array('required' => 'required', 'id' => 'shared_user_id')) !!}
</div>

{!! Form::hidden('datetime', 'Datetime:') !!}
{!! Form::hidden('datetime', $now, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}

{!! Form::hidden('permissions', 'Permissions:') !!}
{!! Form::hidden('permissions', 'basic', ['class' => 'form-control']) !!}

{!! Form::hidden('user_id', 'User Id:') !!}
{!! Form::hidden('user_id', $id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('userSharedProfiles.show', [$id]) !!}" class="btn btn-default">Cancel</a>
</div>