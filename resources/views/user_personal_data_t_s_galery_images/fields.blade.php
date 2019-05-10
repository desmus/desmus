<div class="form-group col-sm-12">
  {!! Form::label('permissions', 'Permissions:') !!}
  {!! Form::select('permissions', array('basic' => 'Read', 'advanced' => 'Update'), $userPersonalDataTSGaleryImage[0] -> permissions, ['class' => 'form-control'], array('required' => 'required', 'id' => 'permissions')) !!}
</div>

{!! Form::hidden('datetime', 'Datetime:') !!}
{!! Form::hidden('datetime', $userPersonalDataTSGaleryImage[0] -> datetime, ['class' => 'form-control'], array('required' => 'required', 'id' => 'user_id')) !!}

{!! Form::hidden('description', 'Description:') !!}
{!! Form::hidden('description', $userPersonalDataTSGaleryImage[0] -> description, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $userPersonalDataTSGaleryImage[0] -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('user_id', 'User Id:') !!}
{!! Form::hidden('user_id', $userPersonalDataTSGaleryImage[0] -> user_id, ['class' => 'form-control']) !!}

{!! Form::hidden('p_d_t_s_g_i_id', 'PersonalData Id:') !!}
{!! Form::hidden('p_d_t_s_g_i_id', $userPersonalDataTSGaleryImage[0] -> p_d_t_s_g_i_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('userPersonalDataTSGaleryImages.show', [$id]) !!}" class="btn btn-default">Cancel</a>
</div>