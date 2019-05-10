<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T Id</th>
        <th colspan="3">Action</th>
        
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTodolistDeletes as $collegeTodolistDelete)
          
        <tr>
            
          <td>{!! $collegeTodolistDelete->datetime !!}</td>
          <td>{!! $collegeTodolistDelete->user_id !!}</td>
          <td>{!! $collegeTodolistDelete->c_t_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTodolistDeletes.show', [$collegeTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
            
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>