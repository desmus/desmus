<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSGalerieUs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User J T S G Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSGalerieUs as $userJobTSGalerieU)
          
        <tr>
              
          <td>{!! $userJobTSGalerieU->datetime !!}</td>
          <td>{!! $userJobTSGalerieU->user_id !!}</td>
          <td>{!! $userJobTSGalerieU->user_j_t_s_g_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTSGalerieUs.show', [$userJobTSGalerieU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>