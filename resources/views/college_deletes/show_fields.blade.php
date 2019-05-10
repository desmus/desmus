<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $collegeDelete->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $collegeDelete->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $collegeDelete->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('college_id', 'College Id:') !!}
  <p>{!! $collegeDelete->college_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $collegeDelete->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $collegeDelete->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $collegeDelete->updated_at !!}</p>
</div>