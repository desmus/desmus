<div class="form-group col-sm-12">
  {!! Form::label('permissions', 'Permissions:') !!}
  {!! Form::select('permissions', array('basic' => 'Read', 'advanced' => 'Update'), $userCollegeTopic[0] -> permissions, ['class' => 'form-control'], array('required' => 'required', 'id' => 'permissions')) !!}
</div>

{!! Form::hidden('datetime', 'Datetime:') !!}
{!! Form::hidden('datetime', $userCollegeTopic[0] -> datetime, ['class' => 'form-control']) !!}

{!! Form::hidden('description', 'Description:') !!}
{!! Form::hidden('description', $userCollegeTopic[0] -> description, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $userCollegeTopic[0] -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('user_id', 'User Id:') !!}
{!! Form::hidden('user_id', $userCollegeTopic[0] -> user_id, ['class' => 'form-control']) !!}

{!! Form::hidden('college_topic_id', 'College Id:') !!}
{!! Form::hidden('college_topic_id', $userCollegeTopic[0] -> college_topic_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('userCollegeTopics.show', [$id]) !!}" class="btn btn-default">Cancel</a>
</div>