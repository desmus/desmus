<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSNoteTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S N T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSNoteTodolistDeletes as $collegeTSNoteTodolistDelete)
          
        <tr>
              
          <td>{!! $collegeTSNoteTodolistDelete->datetime !!}</td>
          <td>{!! $collegeTSNoteTodolistDelete->user_id !!}</td>
          <td>{!! $collegeTSNoteTodolistDelete->c_t_s_n_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTSNoteTodolistDeletes.show', [$collegeTSNoteTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
            
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>