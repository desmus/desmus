<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T Id</th>
        <th colspan="3">Action</th>
        
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTodolistDeletes as $jobTodolistDelete)
          
        <tr>
            
          <td>{!! $jobTodolistDelete->datetime !!}</td>
          <td>{!! $jobTodolistDelete->user_id !!}</td>
          <td>{!! $jobTodolistDelete->j_t_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('jobTodolistDeletes.show', [$jobTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
            
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>