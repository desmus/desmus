<div class="table-responsive">
  
  <table class="table table-bordered table-striped dataTable" id="personalDataTSFileViews-table">
    
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal Data T S File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSFileViews as $personalDataTSFileView)
          
        <tr>
              
          <td>{!! $personalDataTSFileView->datetime !!}</td>
          <td>{!! $personalDataTSFileView->user_id !!}</td>
          <td>{!! $personalDataTSFileView->personal_data_t_s_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSFileViews.show', [$personalDataTSFileView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>