<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSGaleryTodolistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S G T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSGaleryTodolistCreates as $jobTSGaleryTodolistCreate)
          
        <tr>
              
          <td>{!! $jobTSGaleryTodolistCreate->datetime !!}</td>
          <td>{!! $jobTSGaleryTodolistCreate->user_id !!}</td>
          <td>{!! $jobTSGaleryTodolistCreate->c_t_s_g_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSGaleryTodolistCreates.show', [$jobTSGaleryTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>