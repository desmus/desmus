<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSFileDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>College T S File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSFileDeletes as $collegeTSFileDelete)
        
        <tr>
              
          <td>{!! $collegeTSFileDelete->datetime !!}</td>
          <td>{!! $collegeTSFileDelete->user_id !!}</td>
          <td>{!! $collegeTSFileDelete->college_t_s_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('collegeTSFileDeletes.show', [$collegeTSFileDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>