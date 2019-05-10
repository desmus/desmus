<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $recentActivityCreate->id !!}</p>
</div>

<!-- Datetime Field -->
<div class="form-group">
    {!! Form::label('datetime', 'Datetime:') !!}
    <p>{!! $recentActivityCreate->datetime !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $recentActivityCreate->user_id !!}</p>
</div>

<!-- Recent Activity Id Field -->
<div class="form-group">
    {!! Form::label('recent_activity_id', 'Recent Activity Id:') !!}
    <p>{!! $recentActivityCreate->recent_activity_id !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $recentActivityCreate->deleted_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $recentActivityCreate->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $recentActivityCreate->updated_at !!}</p>
</div>

