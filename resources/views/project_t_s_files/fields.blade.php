<div class="form-group col-sm-12">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', $projectTSFile -> name, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', $projectTSFile -> description, ['class' => 'form-control']) !!}
</div>

{!! Form::hidden('views_quantity', 'Views Quantity:') !!}
{!! Form::hidden('views_quantity', $projectTSFile -> views_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
{!! Form::hidden('updates_quantity', $projectTSFile -> updates_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $projectTSFile -> status, ['class' => 'form-control']) !!}

{!! Form::hidden('project_topic_section_id', 'Project Topic Section Id:') !!}
{!! Form::hidden('project_topic_section_id', $projectTSFile -> project_topic_section_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('projectTopicSections.show', [$projectTSFile -> project_topic_section_id]) !!}" class="btn btn-default">Cancel</a>
</div>