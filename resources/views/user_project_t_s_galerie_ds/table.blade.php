<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSGalerieDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User P T S G Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTSGalerieDs as $userProjectTSGalerieD)
          
        <tr>
              
          <td>{!! $userProjectTSGalerieD->datetime !!}</td>
          <td>{!! $userProjectTSGalerieD->user_id !!}</td>
          <td>{!! $userProjectTSGalerieD->user_p_t_s_g_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectTSGalerieDs.show', [$userProjectTSGalerieD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>