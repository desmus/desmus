<table class="table table-hover table-bordered table-striped dataTable" id="projectTSTools-filtered_table" style="margin-bottom: 0;">
  
  <thead>
        
    <tr>
            
      <th>Name</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($projectTSTools as $projectTSTool)
    
      <tr>
            
        <td> <a href = "{!! route('projectTSTools.show', [$projectTSTool->id]) !!}"> {!! $projectTSTool->name !!} </a> </td>
            
        <td>
                
          {!! Form::open(['route' => ['projectTSTools.destroy', $projectTSTool->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('projectTSTools.show', [$projectTSTool->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('projectTSTools.edit', [$projectTSTool->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              <a href="{!! route('userProjectTSTools.show', [$projectTSTool->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-share"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>