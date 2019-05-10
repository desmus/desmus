<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="uPTSPAudioUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P T S P A Id</th>
        <th colspan="3">Action</th>
         
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($uPTSPAudioUpdates as $uPTSPAudioUpdate)
          
        <tr>
              
          <td>{!! $uPTSPAudioUpdate->datetime !!}</td>
          <td>{!! $uPTSPAudioUpdate->user_id !!}</td>
          <td>{!! $uPTSPAudioUpdate->u_p_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('uPTSPAudioUpdates.show', [$uPTSPAudioUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>