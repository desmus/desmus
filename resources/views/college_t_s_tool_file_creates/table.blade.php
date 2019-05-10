<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSToolFileCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>College T S T File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSToolFileCreates as $collegeTSToolFileCreate)
          
        <tr>
              
          <td>{!! $collegeTSToolFileCreate->datetime !!}</td>
          <td>{!! $collegeTSToolFileCreate->user_id !!}</td>
          <td>{!! $collegeTSToolFileCreate->college_t_s_t_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSToolFileCreates.show', [$collegeTSToolFileCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>