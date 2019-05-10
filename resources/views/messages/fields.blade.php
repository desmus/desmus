<div class="form-group col-sm-6">
  {!! Form::label('subject', 'Subject:') !!}
  {!! Form::text('subject', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12 col-lg-12">
  {!! Form::label('content', 'Content:') !!}
  {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('views_quantity', 'Views Quantity:') !!}
  {!! Form::number('views_quantity', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('status', 'Status:') !!}
  <label class="checkbox-inline">
    {!! Form::hidden('status', false) !!}
    {!! Form::checkbox('status', '1', null) !!}
  </label>
</div>

<div class="form-group col-sm-6">
  {!! Form::label('datetime', 'Datetime:') !!}
  {!! Form::date('datetime', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('importance', 'Importance:') !!}
  {!! Form::text('importance', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('s_user_id', 'S User Id:') !!}
  {!! Form::number('s_user_id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('d_user_id', 'D User Id:') !!}
  {!! Form::number('d_user_id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('homes.index') !!}" class="btn btn-default">Cancel</a>
</div>