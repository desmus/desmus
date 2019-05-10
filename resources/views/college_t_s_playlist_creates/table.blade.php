<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSPlaylistCreates-table">
      
    <thead>
          
      <tr>
        
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSPlaylistCreates as $collegeTSPlaylistCreate)
          
        <tr>
              
          <td>{!! $collegeTSPlaylistCreate->datetime !!}</td>
          <td>{!! $collegeTSPlaylistCreate->user_id !!}</td>
          <td>{!! $collegeTSPlaylistCreate->c_t_s_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSPlaylistCreates.show', [$collegeTSPlaylistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>