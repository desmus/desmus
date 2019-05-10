<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSPlaylistCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSPlaylistCreates as $personalDataTSPlaylistCreate)
          
        <tr>
              
          <td>{!! $personalDataTSPlaylistCreate->datetime !!}</td>
          <td>{!! $personalDataTSPlaylistCreate->user_id !!}</td>
          <td>{!! $personalDataTSPlaylistCreate->p_d_t_s_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('personalDataTSPlaylistCreates.show', [$personalDataTSPlaylistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>