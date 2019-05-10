<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSGaleryImageDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User J T S G I Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSGaleryImageDs as $userJobTSGaleryImageD)
          
        <tr>
              
          <td>{!! $userJobTSGaleryImageD->datetime !!}</td>
          <td>{!! $userJobTSGaleryImageD->user_id !!}</td>
          <td>{!! $userJobTSGaleryImageD->user_j_t_s_g_i_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('userJobTSGaleryImageDs.show', [$userJobTSGaleryImageD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>