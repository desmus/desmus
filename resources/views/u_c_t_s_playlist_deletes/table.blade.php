<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="uCTSPlaylistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($uCTSPlaylistDeletes as $uCTSPlaylistDelete)
        
        <tr>
              
          <td>{!! $uCTSPlaylistDelete->datetime !!}</td>
          <td>{!! $uCTSPlaylistDelete->user_id !!}</td>
          <td>{!! $uCTSPlaylistDelete->u_p_d_t_s_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('uCTSPlaylistDeletes.show', [$uCTSPlaylistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>