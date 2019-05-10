<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="uCTSPAudioDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U C T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($uCTSPAudioDeletes as $uCTSPAudioDelete)
          
        <tr>
              
          <td>{!! $uCTSPAudioDelete->datetime !!}</td>
          <td>{!! $uCTSPAudioDelete->user_id !!}</td>
          <td>{!! $uCTSPAudioDelete->u_c_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('uCTSPAudioDeletes.show', [$uCTSPAudioDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>