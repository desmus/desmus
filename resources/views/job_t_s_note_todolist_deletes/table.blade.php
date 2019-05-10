<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSNoteTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>J T S N T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSNoteTodolistDeletes as $jobTSNoteTodolistDelete)
          
        <tr>
              
          <td>{!! $jobTSNoteTodolistDelete->datetime !!}</td>
          <td>{!! $jobTSNoteTodolistDelete->user_id !!}</td>
          <td>{!! $jobTSNoteTodolistDelete->c_t_s_n_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSNoteTodolistDeletes.show', [$jobTSNoteTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
            
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>