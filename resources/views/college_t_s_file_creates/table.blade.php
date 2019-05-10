<div class="table-responsive">
  
  <table class="table table-bordered table-striped dataTable" id="collegeTSFileCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>College T S File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSFileCreates as $collegeTSFileCreate)
          
        <tr>
          
          <td>{!! $collegeTSFileCreate->datetime !!}</td>
          <td>{!! $collegeTSFileCreate->user_id !!}</td>
          <td>{!! $collegeTSFileCreate->college_t_s_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
            
              <a href="{!! route('collegeTSFileCreates.show', [$collegeTSFileCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>