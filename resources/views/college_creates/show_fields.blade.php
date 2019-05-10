<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $collegeCreate->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $collegeCreate->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $collegeCreate->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('college_id', 'College Id:') !!}
  <p>{!! $collegeCreate->college_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $collegeCreate->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $collegeCreate->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $collegeCreate->updated_at !!}</p>
</div>