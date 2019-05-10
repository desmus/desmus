<div class="form-group col-sm-12">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', $collegeTSFile -> name, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', $collegeTSFile -> description, ['class' => 'form-control']) !!}
</div>

{!! Form::hidden('views_quantity', 'Views Quantity:') !!}
{!! Form::hidden('views_quantity', $collegeTSFile -> views_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
{!! Form::hidden('updates_quantity', $collegeTSFile -> updates_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $collegeTSFile -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('college_topic_section_id', 'College Topic Section Id:') !!}
{!! Form::hidden('college_topic_section_id', $collegeTSFile -> college_topic_section_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('collegeTopicSections.show', [$collegeTSFile -> college_topic_section_id]) !!}" class="btn btn-default">Cancel</a>
</div>