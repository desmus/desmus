<div class="form-group col-sm-12">
  {!! Form::label('permissions', 'Permissions:') !!}
  {!! Form::select('permissions', array('basic' => 'Read', 'advanced' => 'Update'), $userPDTSPAudio[0] -> permissions, ['class' => 'form-control'], array('required' => 'required', 'id' => 'permissions')) !!}
</div>

{!! Form::hidden('datetime', 'Datetime:') !!}
{!! Form::hidden('datetime', $userPDTSPAudio[0] -> datetime, ['class' => 'form-control']) !!}

{!! Form::hidden('description', 'Description:') !!}
{!! Form::hidden('description', $userPDTSPAudio[0] -> description, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $userPDTSPAudio[0] -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('user_id', 'User Id:') !!}
{!! Form::hidden('user_id', $userPDTSPAudio[0] -> user_id, ['class' => 'form-control']) !!}

{!! Form::hidden('p_d_t_s_p_a_id', 'PD Id:') !!}
{!! Form::hidden('p_d_t_s_p_a_id', $userPDTSPAudio[0] -> p_d_t_s_p_a_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('userPDTSPAudios.show', [$id]) !!}" class="btn btn-default">Cancel</a>
</div>