<div class="form-group col-sm-12">
  {!! Form::label('permissions', 'Permissions:') !!}
  {!! Form::select('permissions', array('basic' => 'Read', 'advanced' => 'Update'), $userPersonalDataTSP[0] -> permissions, ['class' => 'form-control'], array('required' => 'required', 'id' => 'permissions')) !!}
</div>

{!! Form::hidden('datetime', 'Datetime:') !!}
{!! Form::hidden('datetime', $userPersonalDataTSP[0] -> datetime, ['class' => 'form-control']) !!}

{!! Form::hidden('description', 'Description:') !!}
{!! Form::hidden('description', $userPersonalDataTSP[0] -> description, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $userPersonalDataTSP[0] -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('user_id', 'User Id:') !!}
{!! Form::hidden('user_id', $userPersonalDataTSP[0] -> user_id, ['class' => 'form-control']) !!}

{!! Form::hidden('p_d_t_s_p_id', 'Galery Id:') !!}
{!! Form::hidden('p_d_t_s_p_id', $userPersonalDataTSP[0] -> p_d_t_s_p_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('userPersonalDataTSPs.show', [$id]) !!}" class="btn btn-default">Cancel</a>
</div>