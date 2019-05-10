<div class="form-group col-sm-6">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12 col-lg-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('views_quantity', 'Views Quantity:') !!}
  {!! Form::number('views_quantity', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('updates_quantity', 'Updates Quantity:') !!}
  {!! Form::number('updates_quantity', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('status', 'Status:') !!}
  {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('datetime', 'Datetime:') !!}
  {!! Form::date('datetime', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('p_d_t_s_t_f_id', 'P D T S T F Id:') !!}
  {!! Form::number('p_d_t_s_t_f_id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('personalDataTSTFTodolists.index') !!}" class="btn btn-default">Cancel</a>
</div>