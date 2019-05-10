<div class="form-group col-sm-12">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', $jobTSFile -> name, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', $jobTSFile -> description, ['class' => 'form-control']) !!}
</div>

{!! Form::hidden('views_quantity', 'Views Quantity:') !!}
{!! Form::hidden('views_quantity', $jobTSFile -> views_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
{!! Form::hidden('updates_quantity', $jobTSFile -> updates_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $jobTSFile -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('job_topic_section_id', 'Job Topic Section Id:') !!}
{!! Form::hidden('job_topic_section_id', $jobTSFile -> job_topic_section_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('jobTopicSections.show', [$jobTSFile -> job_topic_section_id]) !!}" class="btn btn-default">Cancel</a>
</div>