<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $userCollegeC->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('datetime', 'Datetime:') !!}
  <p>{!! $userCollegeC->datetime !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $userCollegeC->user_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_c_id', 'User C Id:') !!}
  <p>{!! $userCollegeC->user_c_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('deleted_at', 'Deleted At:') !!}
  <p>{!! $userCollegeC->deleted_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('created_at', 'Created At:') !!}
  <p>{!! $userCollegeC->created_at !!}</p>
</div>

<div class="form-group">
  {!! Form::label('updated_at', 'Updated At:') !!}
  <p>{!! $userCollegeC->updated_at !!}</p>
</div>