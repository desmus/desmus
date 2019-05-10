<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSFileTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
    
    <tbody>
      
      @foreach($collegeTSFileTodolistDeletes as $collegeTSFileTodolistDelete)
          
        <tr>
              
          <td>{!! $collegeTSFileTodolistDelete->datetime !!}</td>
          <td>{!! $collegeTSFileTodolistDelete->user_id !!}</td>
          <td>{!! $collegeTSFileTodolistDelete->c_t_s_f_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSFileTodolistDeletes.show', [$collegeTSFileTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>