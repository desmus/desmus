<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSGalerieCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User J T S G Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSGalerieCs as $userJobTSGalerieC)
          
        <tr>
              
          <td>{!! $userJobTSGalerieC->datetime !!}</td>
          <td>{!! $userJobTSGalerieC->user_id !!}</td>
          <td>{!! $userJobTSGalerieC->user_j_t_s_g_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTSGalerieCs.show', [$userJobTSGalerieC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>