<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSToolFileUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S T F Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSToolFileUpdates as $personalDataTSToolFileUpdate)
          
        <tr>
              
          <td>{!! $personalDataTSToolFileUpdate->actual_name !!}</td>
          <td>{!! $personalDataTSToolFileUpdate->past_name !!}</td>
          <td>{!! $personalDataTSToolFileUpdate->datetime !!}</td>
          <td>{!! $personalDataTSToolFileUpdate->user_id !!}</td>
          <td>{!! $personalDataTSToolFileUpdate->p_d_t_s_t_f_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSToolFileUpdates.show', [$personalDataTSToolFileUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>