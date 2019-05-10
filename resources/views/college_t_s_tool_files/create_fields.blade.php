<div class="form-group col-sm-12">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', null, ['class' => 'form-control'], array('required' => 'required', 'id' => 'name')) !!}
</div>

<!--<div class="form-group col-sm-12">
  
  {!! Form::label('type', 'Type of File:') !!}
  
  <select class="form-control">
    
    <optgroup label="Basic Tools">
      
      <option value="slides">Slides Editor</option>
      <option value="slides">Worksheet Editor</option>
      
    </optgroup>
    
    <optgroup label="Mathematics">
      
      <option value="3d">3D Graphic</option>
      <option value="2d">2D Graphic</option>
      <option value="ecuation_edit">Ecuations Editor</option>
      
    </optgroup>
    
    <optgroup label="Chemistry">
      
      <option value="chemistry_edit">Chemistry Editor</option>
      
    </optgroup>
    
    <optgroup label="3D Tools">
      
      <option value="open_gl">Open GL 3D</option>
      
    </optgroup>
  
  </select>

</div>-->

<div class="form-group col-sm-12">
  {!! Form::label('description', 'Description:') !!}
  {!! Form::textarea('description', 'Add a description ...', ['class' => 'form-control'], array('required' => 'required', 'id' => 'description')) !!}
</div>

<div class="form-group col-sm-12">
  {!! Form::label('file', 'File Type:') !!}
  {!! Form::file('file', null, ['class' => 'form-control'], array('required' => 'required', 'id' => 'file')) !!}
</div>

{!! Form::hidden('file_type', 'File Type:') !!}
{!! Form::hidden('file_type', null, ['class' => 'form-control']) !!}

{!! Form::hidden('views_quantity', 'Views Quantity:') !!}
{!! Form::hidden('views_quantity', 0, ['class' => 'form-control']) !!}

{!! Form::hidden('updates_quantity', 'Updates Quantity:') !!}
{!! Form::hidden('updates_quantity', 0, ['class' => 'form-control']) !!}

{!! Form::hidden('status', 'Status:') !!}
{!! Form::hidden('status', 'on', ['class' => 'form-control']) !!}

{!! Form::hidden('college_t_s_t_id', 'College T S T Id:') !!}
{!! Form::hidden('college_t_s_t_id', $id, ['class' => 'form-control']) !!}

<div class="form-group col-sm-12" style="margin-bottom: 0;">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{!! route('collegeTSTools.show', [$id]) !!}" class="btn btn-default">Cancel</a>
</div>