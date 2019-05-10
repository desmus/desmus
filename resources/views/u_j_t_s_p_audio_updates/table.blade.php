<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="uJTSPAudioUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U J T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($uJTSPAudioUpdates as $uJTSPAudioUpdate)
          
        <tr>
              
          <td>{!! $uJTSPAudioUpdate->datetime !!}</td>
          <td>{!! $uJTSPAudioUpdate->user_id !!}</td>
          <td>{!! $uJTSPAudioUpdate->u_j_t_s_p_a_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('uJTSPAudioUpdates.show', [$uJTSPAudioUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>