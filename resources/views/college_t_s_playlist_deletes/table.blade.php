<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSPlaylistDeletes-table">
      
    <thead>
      
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSPlaylistDeletes as $collegeTSPlaylistDelete)
          
        <tr>
              
          <td>{!! $collegeTSPlaylistDelete->datetime !!}</td>
          <td>{!! $collegeTSPlaylistDelete->user_id !!}</td>
          <td>{!! $collegeTSPlaylistDelete->c_t_s_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSPlaylistDeletes.show', [$collegeTSPlaylistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>