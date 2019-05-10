<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSFileDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal Data T S File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSFileDeletes as $personalDataTSFileDelete)
          
        <tr>
              
          <td>{!! $personalDataTSFileDelete->datetime !!}</td>
          <td>{!! $personalDataTSFileDelete->user_id !!}</td>
          <td>{!! $personalDataTSFileDelete->personal_data_t_s_file_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('personalDataTSFileDeletes.show', [$personalDataTSFileDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>