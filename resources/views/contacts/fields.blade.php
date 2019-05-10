<div class="form-group col-sm-6">
  {!! Form::label('business', 'Business:') !!}
  {!! Form::text('business', $contact -> business, ['class' => 'form-control', 'placeholder' => 'Business Name']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('job', 'Job:') !!}
  {!! Form::text('job', $contact -> job, ['class' => 'form-control', 'placeholder' => 'Job Name']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('country', 'Country:') !!}
  {!! Form::text('country', $contact -> country, ['class' => 'form-control', 'placeholder' => 'Country Name']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('birthdate', 'Birthdate:') !!}
  {!! Form::date('birthdate', $contact -> birthdate, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd']) !!}
</div>

{!! Form::hidden('specific_info', 'Specific Info:') !!}
{!! Form::hidden('specific_info', $contact -> specific_info, ['class' => 'form-control']) !!}

{!! Form::hidden('views_quantity', 'Views Quantity:') !!}
{!! Form::hidden('views_quantity', $contact -> views_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
{!! Form::hidden('updates_quantity', $contact -> updates_quantity, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', $contact -> status, ['class' => 'form-control']) !!}
  
{!! Form::hidden('user_id', 'User Id:') !!}
{!! Form::hidden('user_id', $contact -> user_id, ['class' => 'form-control']) !!}

{!! Form::hidden('contact_id', 'Contact Id:') !!}
{!! Form::hidden('contact_id', $contact -> contact_id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('homes.index') !!}" class="btn btn-default">Cancel</a>
</div>