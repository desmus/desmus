<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="uPTSPAudioCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($uPTSPAudioCreates as $uPTSPAudioCreate)
          
        <tr>
              
          <td>{!! $uPTSPAudioCreate->datetime !!}</td>
          <td>{!! $uPTSPAudioCreate->user_id !!}</td>
          <td>{!! $uPTSPAudioCreate->u_p_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('uPTSPAudioCreates.show', [$uPTSPAudioCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>