<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSGaleryViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal D T S G Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSGaleryViews as $personalDataTSGaleryView)
          
        <tr>
              
          <td>{!! $personalDataTSGaleryView->datetime !!}</td>
          <td>{!! $personalDataTSGaleryView->user_id !!}</td>
          <td>{!! $personalDataTSGaleryView->personal_d_t_s_g_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSGaleryViews.show', [$personalDataTSGaleryView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>