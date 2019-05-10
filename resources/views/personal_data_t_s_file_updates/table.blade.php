<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSFileUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal Data T S File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSFileUpdates as $personalDataTSFileUpdate)
          
        <tr>
              
          <td>{!! $personalDataTSFileUpdate->actual_name !!}</td>
          <td>{!! $personalDataTSFileUpdate->past_name !!}</td>
          <td>{!! $personalDataTSFileUpdate->datetime !!}</td>
          <td>{!! $personalDataTSFileUpdate->user_id !!}</td>
          <td>{!! $personalDataTSFileUpdate->personal_data_t_s_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSFileUpdates.show', [$personalDataTSFileUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>