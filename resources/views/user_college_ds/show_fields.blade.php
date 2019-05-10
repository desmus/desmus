<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $userCollegeD->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $userCollegeD->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $userCollegeD->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_c_id', 'User C Id:') !!}
  <p>{!! $userCollegeD->user_c_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $userCollegeD->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $userCollegeD->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $userCollegeD->updated_at !!}</p>
</div>