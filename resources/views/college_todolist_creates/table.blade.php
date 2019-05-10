<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTodolistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTodolistCreates as $collegeTodolistCreate)
          
        <tr>
              
          <td>{!! $collegeTodolistCreate->datetime !!}</td>
          <td>{!! $collegeTodolistCreate->user_id !!}</td>
          <td>{!! $collegeTodolistCreate->c_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTodolistCreates.show', [$collegeTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
            
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>

</div>