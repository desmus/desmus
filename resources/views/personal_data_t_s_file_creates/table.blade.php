<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSFileCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal Data T S File Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSFileCreates as $personalDataTSFileCreate)
          
        <tr>
              
          <td>{!! $personalDataTSFileCreate->datetime !!}</td>
          <td>{!! $personalDataTSFileCreate->user_id !!}</td>
          <td>{!! $personalDataTSFileCreate->personal_data_t_s_file_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSFileCreates.show', [$personalDataTSFileCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>