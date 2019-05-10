<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $contactWebView->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $contactWebView->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $contactWebView->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('contact_web_id', 'Contact Web Id:') !!}
  <p>{!! $contactWebView->contact_web_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $contactWebView->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $contactWebView->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $contactWebView->updated_at !!}</p>
</div>