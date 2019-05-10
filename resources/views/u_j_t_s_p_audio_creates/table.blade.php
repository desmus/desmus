<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="uJTSPAudioCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U J T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($uJTSPAudioCreates as $uJTSPAudioCreate)
          
        <tr>
                
          <td>{!! $uJTSPAudioCreate->datetime !!}</td>
          <td>{!! $uJTSPAudioCreate->user_id !!}</td>
          <td>{!! $uJTSPAudioCreate->u_j_t_s_p_a_id !!}</td>
                
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('uJTSPAudioCreates.show', [$uJTSPAudioCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
            
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>