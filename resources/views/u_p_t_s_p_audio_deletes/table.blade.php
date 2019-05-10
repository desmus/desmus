<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="uPTSPAudioDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
    
    <tbody>
      
      @foreach($uPTSPAudioDeletes as $uPTSPAudioDelete)
          
        <tr>
              
          <td>{!! $uPTSPAudioDelete->datetime !!}</td>
          <td>{!! $uPTSPAudioDelete->user_id !!}</td>
          <td>{!! $uPTSPAudioDelete->u_p_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('uPTSPAudioDeletes.show', [$uPTSPAudioDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>