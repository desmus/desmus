<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSFileTodolistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S F T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSFileTodolistCreates as $collegeTSFileTodolistCreate)
          
        <tr>
              
          <td>{!! $collegeTSFileTodolistCreate->datetime !!}</td>
          <td>{!! $collegeTSFileTodolistCreate->user_id !!}</td>
          <td>{!! $collegeTSFileTodolistCreate->c_t_s_f_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTSFileTodolistCreates.show', [$collegeTSFileTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>