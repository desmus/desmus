<div class="form-group col-sm-12">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', $publicNote -> name, ['class' => 'form-control'], array('required' => 'required', 'id' => 'name')) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', $publicNote -> description, ['class' => 'form-control'], array('required' => 'required', 'id' => 'description')) !!}
</div>

{!! Form::hidden('content', 'Content:') !!}
{!! Form::hidden('content', $publicNote -> content, ['class' => 'form-control']) !!}

{!! Form::hidden('views_quantity', 'Views Quantity:') !!}
{!! Form::hidden('views_quantity', $publicNote -> views_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
{!! Form::hidden('updates_quantity', $publicNote -> updates_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $publicNote -> updates_quantity, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('publicProfile.index') !!}" class="btn btn-default">Cancel</a>
</div>