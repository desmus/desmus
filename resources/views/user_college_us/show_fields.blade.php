<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $userCollegeU->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $userCollegeU->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $userCollegeU->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_c_id', 'User C Id:') !!}
  <p>{!! $userCollegeU->user_c_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $userCollegeU->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $userCollegeU->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $userCollegeU->updated_at !!}</p>
</div>