<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="uCTSPAudioCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U C T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($uCTSPAudioCreates as $uCTSPAudioCreate)
          
        <tr>
              
          <td>{!! $uCTSPAudioCreate->datetime !!}</td>
          <td>{!! $uCTSPAudioCreate->user_id !!}</td>
          <td>{!! $uCTSPAudioCreate->u_c_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('uCTSPAudioCreates.show', [$uCTSPAudioCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
    
    </tbody>
  
  </table>
  
</div>