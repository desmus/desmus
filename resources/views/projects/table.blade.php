<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projects-table" style="margin-bottom: 0;">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($projects as $project)
          
        <tr>
              
          <td><a> <a href = "{!! route('projects.show', [$project->id]) !!}"> {!! $project->name !!} </a> </td>
          <td>
                  
            {!! Form::open(['route' => ['projects.destroy', $project->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('projects.show', [$project->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('projects.edit', [$project->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('userProjects.show', [$project->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-share"></i></a>
                
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>