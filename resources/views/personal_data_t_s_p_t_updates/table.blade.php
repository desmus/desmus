<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSPTUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S P T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSPTUpdates as $personalDataTSPTUpdate)
          
        <tr>
              
          <td>{!! $personalDataTSPTUpdate->actual_name !!}</td>
          <td>{!! $personalDataTSPTUpdate->past_name !!}</td>
          <td>{!! $personalDataTSPTUpdate->datetime !!}</td>
          <td>{!! $personalDataTSPTUpdate->user_id !!}</td>
          <td>{!! $personalDataTSPTUpdate->p_d_t_s_p_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSPTUpdates.show', [$personalDataTSPTUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>