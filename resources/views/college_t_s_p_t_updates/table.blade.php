<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSPTUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S P T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSPTUpdates as $collegeTSPTUpdate)
          
        <tr>
          
          <td>{!! $collegeTSPTUpdate->actual_name !!}</td>
          <td>{!! $collegeTSPTUpdate->past_name !!}</td>
          <td>{!! $collegeTSPTUpdate->datetime !!}</td>
          <td>{!! $collegeTSPTUpdate->user_id !!}</td>
          <td>{!! $collegeTSPTUpdate->c_t_s_p_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSPTUpdates.show', [$collegeTSPTUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>