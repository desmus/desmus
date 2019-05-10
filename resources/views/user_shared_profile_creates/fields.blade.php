<!-- Datetime Field -->
<div class="form-group col-sm-6">
    {!! Form::label('datetime', 'Datetime:') !!}
    {!! Form::date('datetime', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Shared Profile Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_shared_profile_id', 'User Shared Profile Id:') !!}
    {!! Form::number('user_shared_profile_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('userSharedProfileCreates.index') !!}" class="btn btn-default">Cancel</a>
</div>
