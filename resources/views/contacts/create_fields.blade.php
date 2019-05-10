<div class="form-group col-sm-6">
  {!! Form::label('business', 'Business:') !!}
  {!! Form::text('business', null, ['class' => 'form-control', 'placeholder' => 'Business Name', 'required' => 'required']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('job', 'Job:') !!}
  {!! Form::text('job', null, ['class' => 'form-control', 'placeholder' => 'Job Name', 'required' => 'required']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('country', 'Country:') !!}
  {!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => 'Country Name', 'required' => 'required']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('birthdate', 'Birthdate:') !!}
  {!! Form::date('birthdate', null, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'required' => 'required']) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::label('contact_id', 'Search User:') !!}
  <input type="text" class="form-control" id="userSearch" name="search" placeholder="Search user email..."/>
</div>

<div id="section_search" class="form-group col-sm-12">

   <table class="table table-responsive">
      
    <thead>
          
      <tr>
             
        <th>Select</th>
        <th>Name</th>
        <th>Email</th>
          
      </tr>
      
    </thead>
      
    <tbody id = "t_user_search">

    </tbody>

  </table>

</div>

{!! Form::hidden('user_id', 'User Id:') !!}
{!! Form::hidden('user_id', $user_id, ['class' => 'form-control']) !!}

{!! Form::hidden('specific_info', 'Specific Info:') !!}
{!! Form::hidden('specific_info', 'Write Here ...', ['class' => 'form-control']) !!}

{!! Form::hidden('views_quantity', 'Views Quantity:') !!}
{!! Form::hidden('views_quantity', 0, ['class' => 'form-control']) !!}

{!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
{!! Form::hidden('updates_quantity', 0, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('homes.index') !!}" class="btn btn-default">Cancel</a>
</div>