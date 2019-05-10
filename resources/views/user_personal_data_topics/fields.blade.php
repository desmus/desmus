<div class="form-group col-sm-12">
  {!! Form::label('permissions', 'Permissions:') !!}
  {!! Form::select('permissions', array('basic' => 'Read', 'advanced' => 'Update'), $userPersonalDataTopic[0] -> permissions, ['class' => 'form-control'], array('required' => 'required', 'id' => 'permissions')) !!}
</div>

{!! Form::hidden('datetime', 'Datetime:') !!}
{!! Form::hidden('datetime', $userPersonalDataTopic[0] -> datetime, ['class' => 'form-control']) !!}

{!! Form::hidden('description', 'Description:') !!}
{!! Form::hidden('description', $userPersonalDataTopic[0] -> description, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $userPersonalDataTopic[0] -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('user_id', 'User Id:') !!}
{!! Form::hidden('user_id', $userPersonalDataTopic[0] -> user_id, ['class' => 'form-control']) !!}

{!! Form::hidden('personal_data_topic_id', 'PersonalData Id:') !!}
{!! Form::hidden('personal_data_topic_id', $userPersonalDataTopic[0] -> personal_data_topic_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('userPersonalDataTopics.show', [$id]) !!}" class="btn btn-default">Cancel</a>
</div>