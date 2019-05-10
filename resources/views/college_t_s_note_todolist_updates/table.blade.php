<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSNoteTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S N T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($collegeTSNoteTodolistUpdates as $collegeTSNoteTodolistUpdate)
          
        <tr>
              
          <td>{!! $collegeTSNoteTodolistUpdate->actual_name !!}</td>
          <td>{!! $collegeTSNoteTodolistUpdate->past_name !!}</td>
          <td>{!! $collegeTSNoteTodolistUpdate->datetime !!}</td>
          <td>{!! $collegeTSNoteTodolistUpdate->user_id !!}</td>
          <td>{!! $collegeTSNoteTodolistUpdate->c_t_s_n_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTSNoteTodolistUpdates.show', [$collegeTSNoteTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>