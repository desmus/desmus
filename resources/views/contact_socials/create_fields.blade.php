<div class="form-group col-sm-12">
  {!! Form::label('link', 'Link:') !!}
  {!! Form::text('link', null, ['class' => 'form-control', 'placeholder' => 'http://www.example.com', 'required' => 'required']) !!}
</div>

{!! Form::hidden('contact_id', 'Contact Id:') !!}
{!! Form::hidden('contact_id', $id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('contacts.show', [$id]) !!}" class="btn btn-default">Cancel</a>
</div>