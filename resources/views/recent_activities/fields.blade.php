<div class="form-group col-sm-6">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', null, ['class' => 'form-control']) !!}

{!! Form::hidden('type', 'Type:') !!}
{!! Form::hidden('type', null, ['class' => 'form-control']) !!}

{!! Form::hidden('entity_id', 'Entity Id:') !!}
{!! Form::hidden('entity_id', null, ['class' => 'form-control']) !!}

{!! Form::hidden('user_id', 'Status:') !!}
{!! Form::hidden('user_id', null, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('recentActivities.index') !!}" class="btn btn-default">Cancel</a>
</div>