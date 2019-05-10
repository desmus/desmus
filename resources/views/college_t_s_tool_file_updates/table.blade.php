<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSToolFileUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>College T S T File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSToolFileUpdates as $collegeTSToolFileUpdate)
          
        <tr>
              
          <td>{!! $collegeTSToolFileUpdate->actual_name !!}</td>
          <td>{!! $collegeTSToolFileUpdate->past_name !!}</td>
          <td>{!! $collegeTSToolFileUpdate->datetime !!}</td>
          <td>{!! $collegeTSToolFileUpdate->user_id !!}</td>
          <td>{!! $collegeTSToolFileUpdate->college_t_s_t_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSToolFileUpdates.show', [$collegeTSToolFileUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>