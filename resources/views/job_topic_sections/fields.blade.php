<div class="form-group col-sm-6">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', null, ['class' => 'form-control'], array('required' => 'required', 'id' => 'name')) !!}
</div>

{!! Form::hidden('specific_info', 'Specific Info:') !!}
{!! Form::hidden('specific_info', $jobTopicSection -> specific_info, ['class' => 'form-control']) !!}

{!! Form::hidden('views_quantity', 'Views Quantity:') !!}
{!! Form::hidden('views_quantity', $jobTopicSection -> views_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
{!! Form::hidden('updates_quantity', $jobTopicSection -> updates_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}

{!! Form::hidden('job_topic_id', 'Job Topic Id:') !!}
{!! Form::hidden('job_topic_id', $jobTopicSection -> job_topic_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('jobTopics.show', [$jobTopicSection -> job_topic_id]) !!}" class="btn btn-default">Cancel</a>
</div>