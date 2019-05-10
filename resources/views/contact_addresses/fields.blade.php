<div class="form-group col-sm-12">
  {!! Form::label('street', 'Street:') !!}
  {!! Form::text('street', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('num_ext', 'Num Ext:') !!}
  {!! Form::text('num_ext', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('num_int', 'Num Int:') !!}
  {!! Form::text('num_int', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-4">
  {!! Form::label('state', 'State:') !!}
  {!! Form::text('state', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-4">
  {!! Form::label('municipality', 'Municipality:') !!}
  {!! Form::text('municipality', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-4">
  {!! Form::label('postal_code', 'Postal Code:') !!}
  {!! Form::text('postal_code', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::label('location', 'Location:') !!}
  {!! Form::text('location', null, ['class' => 'form-control']) !!}
</div>

{!! Form::hidden('contact_id', 'Contact Id:') !!}
{!! Form::hidden('contact_id', $id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('contacts.show', [$id]) !!}" class="btn btn-default">Cancel</a>
</div>