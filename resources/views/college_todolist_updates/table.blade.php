<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTodolistUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTodolistUpdates as $collegeTodolistUpdate)
          
        <tr>
              
          <td>{!! $collegeTodolistUpdate->actual_name !!}</td>
          <td>{!! $collegeTodolistUpdate->past_name !!}</td>
          <td>{!! $collegeTodolistUpdate->datetime !!}</td>
          <td>{!! $collegeTodolistUpdate->user_id !!}</td>
          <td>{!! $collegeTodolistUpdate->c_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTodolistUpdates.show', [$collegeTodolistUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                                      
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>

</div>