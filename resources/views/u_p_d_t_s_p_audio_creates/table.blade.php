<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="uPDTSPAudioCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($uPDTSPAudioCreates as $uPDTSPAudioCreate)
          
        <tr>
              
          <td>{!! $uPDTSPAudioCreate->datetime !!}</td>
          <td>{!! $uPDTSPAudioCreate->user_id !!}</td>
          <td>{!! $uPDTSPAudioCreate->u_p_d_t_s_p_a_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('uPDTSPAudioCreates.show', [$uPDTSPAudioCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>