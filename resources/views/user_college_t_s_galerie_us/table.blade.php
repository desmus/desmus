<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTSGalerieUs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User C T S G Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTSGalerieUs as $userCollegeTSGalerieU)
          
        <tr>
              
          <td>{!! $userCollegeTSGalerieU->datetime !!}</td>
          <td>{!! $userCollegeTSGalerieU->user_id !!}</td>
          <td>{!! $userCollegeTSGalerieU->user_c_t_s_g_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userCollegeTSGalerieUs.show', [$userCollegeTSGalerieU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>