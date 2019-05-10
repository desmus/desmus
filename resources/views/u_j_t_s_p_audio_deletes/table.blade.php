<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="uJTSPAudioDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U J T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($uJTSPAudioDeletes as $uJTSPAudioDelete)
          
        <tr>
              
          <td>{!! $uJTSPAudioDelete->datetime !!}</td>
          <td>{!! $uJTSPAudioDelete->user_id !!}</td>
          <td>{!! $uJTSPAudioDelete->u_j_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('uJTSPAudioDeletes.show', [$uJTSPAudioDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>