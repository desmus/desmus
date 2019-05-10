<div class="form-group col-sm-12">
  {!! Form::label('permissions', 'Permissions:') !!}
  {!! Form::select('permissions', array('basic' => 'Read', 'advanced' => 'Update'), $userJobTSGaleryImage[0] -> permissions, ['class' => 'form-control'], array('required' => 'required', 'id' => 'permissions')) !!}
</div>

{!! Form::hidden('datetime', 'Datetime:') !!}
{!! Form::hidden('datetime', $userJobTSGaleryImage[0] -> datetime, ['class' => 'form-control']) !!}

{!! Form::hidden('description', 'Description:') !!}
{!! Form::hidden('description', $userJobTSGaleryImage[0] -> description, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $userJobTSGaleryImage[0] -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('user_id', 'User Id:') !!}
{!! Form::hidden('user_id', $userJobTSGaleryImage[0] -> user_id, ['class' => 'form-control']) !!}

{!! Form::hidden('job_t_s_g_image_id', 'Job Id:') !!}
{!! Form::hidden('job_t_s_g_image_id', $userJobTSGaleryImage[0] -> job_t_s_g_image_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('userJobTSGaleryImages.show', [$id]) !!}" class="btn btn-default">Cancel</a>
</div>