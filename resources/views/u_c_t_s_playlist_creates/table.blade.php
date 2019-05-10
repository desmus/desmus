<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="uCTSPlaylistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($uCTSPlaylistCreates as $uCTSPlaylistCreate)
          
        <tr>
              
          <td>{!! $uCTSPlaylistCreate->datetime !!}</td>
          <td>{!! $uCTSPlaylistCreate->user_id !!}</td>
          <td>{!! $uCTSPlaylistCreate->u_p_d_t_s_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('uCTSPlaylistCreates.show', [$uCTSPlaylistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>