<div class="form-group col-sm-12">
  {!! Form::label('permissions', 'Permissions:') !!}
  {!! Form::select('permissions', array('basic' => 'Read', 'advanced' => 'Update'), $userCollegeTSGalerie[0] -> permissions, ['class' => 'form-control'], array('required' => 'required', 'id' => 'permissions')) !!}
</div>

{!! Form::hidden('datetime', 'Datetime:') !!}
{!! Form::hidden('datetime', $userCollegeTSGalerie[0] -> datetime, ['class' => 'form-control']) !!}

{!! Form::hidden('description', 'Description:') !!}
{!! Form::hidden('description', $userCollegeTSGalerie[0] -> description, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $userCollegeTSGalerie[0] -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('user_id', 'User Id:') !!}
{!! Form::hidden('user_id', $userCollegeTSGalerie[0] -> user_id, ['class' => 'form-control']) !!}

{!! Form::hidden('college_t_s_galery_id', 'Galery Id:') !!}
{!! Form::hidden('college_t_s_galery_id', $userCollegeTSGalerie[0] -> college_t_s_galery_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('userCollegeTSGaleries.show', [$id]) !!}" class="btn btn-default">Cancel</a>
</div>