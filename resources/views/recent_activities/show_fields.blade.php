<div class="form-group">
  {!! Form::label('id', 'Id:') !!}
  <p>{!! $recentActivity->id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('name', 'Name:') !!}
  <p>{!! $recentActivity->name !!}</p>
</div>

<div class="form-group">
  {!! Form::label('status', 'Status:') !!}
  <p>{!! $recentActivity->status !!}</p>
</div>

<div class="form-group">
  {!! Form::label('type', 'Type:') !!}
  <p>{!! $recentActivity->type !!}</p>
</div>

<div class="form-group">
  {!! Form::label('entity_id', 'Entity Id:') !!}
  <p>{!! $recentActivity->entity_id !!}</p>
</div>

<div class="form-group">
  {!! Form::label('user_id', 'User Id:') !!}
  <p>{!! $recentActivity->user_id !!}</p>
</div>

<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $recentActivity->deleted_at !!}</p>
</div>

<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $recentActivity->created_at !!}</p>
</div>

<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $recentActivity->updated_at !!}</p>
</div>