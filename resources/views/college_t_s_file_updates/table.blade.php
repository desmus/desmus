<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSFileUpdates-table">
    
    <thead>
      
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>College T S File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSFileUpdates as $collegeTSFileUpdate)
          
        <tr>
              
          <td>{!! $collegeTSFileUpdate->actual_name !!}</td>
          <td>{!! $collegeTSFileUpdate->past_name !!}</td>
          <td>{!! $collegeTSFileUpdate->datetime !!}</td>
          <td>{!! $collegeTSFileUpdate->user_id !!}</td>
          <td>{!! $collegeTSFileUpdate->college_t_s_file_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTSFileUpdates.show', [$collegeTSFileUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>