<div class="form-group col-sm-12">
  {!! Form::label('permissions', 'Permissions:') !!}
  {!! Form::select('permissions', array('basic' => 'Read', 'advanced' => 'Update'), $userPersonalDataTSNote[0] -> permissions, ['class' => 'form-control'], array('required' => 'required', 'id' => 'permissions')) !!}
</div>

{!! Form::hidden('datetime', 'Datetime:') !!}
{!! Form::hidden('datetime', $userPersonalDataTSNote[0] -> datetime, ['class' => 'form-control']) !!}

{!! Form::hidden('description', 'Description:') !!}
{!! Form::hidden('description', $userPersonalDataTSNote[0] -> description, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $userPersonalDataTSNote[0] -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('user_id', 'User Id:') !!}
{!! Form::hidden('user_id', $userPersonalDataTSNote[0] -> user_id, ['class' => 'form-control']) !!}

{!! Form::hidden('personal_data_t_s_note_id', 'PersonalData Id:') !!}
{!! Form::hidden('personal_data_t_s_note_id', $userPersonalDataTSNote[0] -> personal_data_t_s_note_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('userPersonalDataTSNotes.show', [$id]) !!}" class="btn btn-default">Cancel</a>
</div>