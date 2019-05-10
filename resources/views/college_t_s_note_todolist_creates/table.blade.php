<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSNoteTodolistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S N T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSNoteTodolistCreates as $collegeTSNoteTodolistCreate)
          
        <tr>
              
          <td>{!! $collegeTSNoteTodolistCreate->datetime !!}</td>
          <td>{!! $collegeTSNoteTodolistCreate->user_id !!}</td>
          <td>{!! $collegeTSNoteTodolistCreate->c_t_s_n_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSNoteTodolistCreates.show', [$collegeTSNoteTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>