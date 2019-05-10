<div class="form-group col-sm-12">
  {!! Form::label('street', 'Street:') !!}
  {!! Form::text('street', null, ['class' => 'form-control', 'placeholder' => 'Street Name', 'required' => 'required']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('num_ext', 'Num Ext:') !!}
  {!! Form::text('num_ext', null, ['class' => 'form-control', 'placeholder' => '600', 'required' => 'required']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('num_int', 'Num Int:') !!}
  {!! Form::text('num_int', null, ['class' => 'form-control', 'placeholder' => '40-A', 'required' => 'required']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('state', 'State:') !!}
  {!! Form::text('state', null, ['class' => 'form-control', 'placeholder' => 'State Name', 'required' => 'required']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('municipality', 'Municipality:') !!}
  {!! Form::text('municipality', null, ['class' => 'form-control', 'placeholder' => 'Municipality Name', 'required' => 'required']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('postal_code', 'Postal Code:') !!}
  {!! Form::text('postal_code', null, ['class' => 'form-control', 'placeholder' => '56500', 'required' => 'required']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('location', 'Location:') !!}
  {!! Form::text('location', null, ['class' => 'form-control', 'placeholder' => '<iframe src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d15049.546165186595!2d-99.20428867083488!3d19.4388942900904!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e6!4m3!3m2!1d19.4418775!2d-99.20145219999999!4m5!1s0x85d202007a456ee1%3A0xf1ba76a040a41257!2sel+secreto+de+polanco+restaurante!3m2!1d19.433064299999998!2d-99.19049059999999!5e0!3m2!1ses!2smx!4v1539276171889" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>', 'required' => 'required']) !!}
</div>

{!! Form::hidden('contact_id', 'Contact Id:') !!}
{!! Form::hidden('contact_id', $id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('contacts.show', [$id]) !!}" class="btn btn-default">Cancel</a>
</div>