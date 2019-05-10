<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $user->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('name', 'Name:') !!}
  <p>{!! $user->name !!}</p>
</div>

<div class="form-group">
  {!! Form::label('email', 'Email:') !!}
  <p>{!! $user->email !!}</p>
</div>

<div class="form-group">
  {!! Form::label('password', 'Password:') !!}
  <p>{!! $user->password !!}</p>
</div>

<div class="form-group">
  {!! Form::label('verified_account', 'Verified Account:') !!}
  <p>{!! $user->verified_account !!}</p>
</div>

<div class="form-group">
  {!! Form::label('status', 'Status:') !!}
  <p>{!! $user->status !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $user->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('remember_token', 'Remember Token:') !!}
  <p>{!! $user->remember_token !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $user->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $user->updated_at !!}</p>
</div>