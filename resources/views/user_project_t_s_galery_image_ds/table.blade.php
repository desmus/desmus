<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSGaleryImageDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User P T S G I Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTSGaleryImageDs as $userProjectTSGaleryImageD)
          
        <tr>
              
          <td>{!! $userProjectTSGaleryImageD->datetime !!}</td>
          <td>{!! $userProjectTSGaleryImageD->user_id !!}</td>
          <td>{!! $userProjectTSGaleryImageD->user_p_t_s_g_i_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectTSGaleryImageDs.show', [$userProjectTSGaleryImageD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>