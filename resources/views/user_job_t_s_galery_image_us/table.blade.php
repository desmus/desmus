<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSGaleryImageUs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User J T S G I Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSGaleryImageUs as $userJobTSGaleryImageU)
          
        <tr>
              
          <td>{!! $userJobTSGaleryImageU->datetime !!}</td>
          <td>{!! $userJobTSGaleryImageU->user_id !!}</td>
          <td>{!! $userJobTSGaleryImageU->user_j_t_s_g_i_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTSGaleryImageUs.show', [$userJobTSGaleryImageU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
        
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>