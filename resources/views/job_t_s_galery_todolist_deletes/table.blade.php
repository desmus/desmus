<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSGaleryTodolistDeletes-table">
    
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S G T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($jobTSGaleryTodolistDeletes as $jobTSGaleryTodolistDelete)
          
        <tr>
              
          <td>{!! $jobTSGaleryTodolistDelete->datetime !!}</td>
          <td>{!! $jobTSGaleryTodolistDelete->user_id !!}</td>
          <td>{!! $jobTSGaleryTodolistDelete->c_t_s_g_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('jobTSGaleryTodolistDeletes.show', [$jobTSGaleryTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>