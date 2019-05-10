<div class="form-group col-sm-12">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', $jobTSNote -> name, ['class' => 'form-control'], array('required' => 'required', 'id' => 'name')) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', $jobTSNote -> description, ['class' => 'form-control'], array('required' => 'required', 'id' => 'description')) !!}
</div>

{!! Form::hidden('content', 'Content:') !!}
{!! Form::hidden('content', $jobTSNote -> content, ['class' => 'form-control']) !!}

{!! Form::hidden('views_quantity', 'Views Quantity:') !!}
{!! Form::hidden('views_quantity', $jobTSNote -> views_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
{!! Form::hidden('updates_quantity', $jobTSNote -> updates_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $jobTSNote -> updates_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('job_topic_section_id', 'Job Topic Section Id:') !!}
{!! Form::hidden('job_topic_section_id', $jobTSNote -> job_topic_section_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('jobTopicSections.show', [$jobTSNote -> job_topic_section_id]) !!}" class="btn btn-default">Cancel</a>
</div>