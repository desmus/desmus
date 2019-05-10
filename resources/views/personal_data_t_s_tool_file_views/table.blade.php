<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSToolFileViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal D T S T F Id</th>
        <th colspan="3">Action</th>
      
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSToolFileViews as $personalDataTSToolFileView)
          
        <tr>
              
          <td>{!! $personalDataTSToolFileView->datetime !!}</td>
          <td>{!! $personalDataTSToolFileView->user_id !!}</td>
          <td>{!! $personalDataTSToolFileView->personal_d_t_s_t_f_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSToolFileViews.show', [$personalDataTSToolFileView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
        
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>