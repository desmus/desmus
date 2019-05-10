<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSToolUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal Data T S Tool Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSToolUpdates as $personalDataTSToolUpdate)
          
        <tr>
              
          <td>{!! $personalDataTSToolUpdate->actual_name !!}</td>
          <td>{!! $personalDataTSToolUpdate->past_name !!}</td>
          <td>{!! $personalDataTSToolUpdate->datetime !!}</td>
          <td>{!! $personalDataTSToolUpdate->user_id !!}</td>
          <td>{!! $personalDataTSToolUpdate->personal_data_t_s_tool_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSToolUpdates.show', [$personalDataTSToolUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>