<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="uCTSPAudioUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U C T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($uCTSPAudioUpdates as $uCTSPAudioUpdate)
          
        <tr>
              
          <td>{!! $uCTSPAudioUpdate->datetime !!}</td>
          <td>{!! $uCTSPAudioUpdate->user_id !!}</td>
          <td>{!! $uCTSPAudioUpdate->u_c_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('uCTSPAudioUpdates.show', [$uCTSPAudioUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>