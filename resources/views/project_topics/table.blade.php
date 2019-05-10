<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTopics-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>User</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($projectTopics as $projectTopic)
          
        <tr>
              
          <td><a> <a href = "{!! route('projectTopics.show', [$projectTopic->id]) !!}"> {!! $projectTopic->name !!} </a> </td>
          <td>{!! $projectTopic->project_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectTopics.show', [$projectTopic->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                 
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>