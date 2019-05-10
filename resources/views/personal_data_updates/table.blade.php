<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal Data Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataUpdates as $personalDataUpdate)
          
        <tr>
              
          <td>{!! $personalDataUpdate->actual_name !!}</td>
          <td>{!! $personalDataUpdate->past_name !!}</td>
          <td>{!! $personalDataUpdate->datetime !!}</td>
          <td>{!! $personalDataUpdate->user_id !!}</td>
          <td>{!! $personalDataUpdate->personal_data_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                
              <a href="{!! route('personalDataUpdates.show', [$personalDataUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>