<div class="form-group col-sm-12">
  {!! Form::label('permissions', 'Permissions:') !!}
  {!! Form::select('permissions', array('basic' => 'Read', 'advanced' => 'Update'), $userCollegeTopicSection[0] -> permissions, ['class' => 'form-control'], array('required' => 'required', 'id' => 'permissions')) !!}
</div>

{!! Form::hidden('datetime', 'Datetime:') !!}
{!! Form::hidden('datetime', $userCollegeTopicSection[0] -> datetime, ['class' => 'form-control']) !!}

{!! Form::hidden('description', 'Description:') !!}
{!! Form::hidden('description', $userCollegeTopicSection[0] -> description, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $userCollegeTopicSection[0] -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('user_id', 'User Id:') !!}
{!! Form::hidden('user_id', $userCollegeTopicSection[0] -> user_id, ['class' => 'form-control']) !!}

{!! Form::hidden('college_topic_section_id', 'College Id:') !!}
{!! Form::hidden('college_topic_section_id', $userCollegeTopicSection[0] -> college_topic_section_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('userCollegeTopicSections.show', [$id]) !!}" class="btn btn-default">Cancel</a>
</div>