<div class="form-group col-sm-6">
  {!! Form::label('email', 'Email:') !!}
  {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'example@domain.com', 'required' => 'required']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('type', 'Type:') !!}
  {!! Form::text('type', null, ['class' => 'form-control', 'placeholder' => 'Personal, Private, Job, ...', 'required' => 'required']) !!}
</div>

{!! Form::hidden('contact_id', 'Contact Id:') !!}
{!! Form::hidden('contact_id', $id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('contacts.show', [$id]) !!}" class="btn btn-default">Cancel</a>
</div>