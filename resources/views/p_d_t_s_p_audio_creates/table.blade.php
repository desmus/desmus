<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="pDTSPAudioCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P D T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($pDTSPAudioCreates as $pDTSPAudioCreate)
          
        <tr>
              
          <td>{!! $pDTSPAudioCreate->datetime !!}</td>
          <td>{!! $pDTSPAudioCreate->user_id !!}</td>
          <td>{!! $pDTSPAudioCreate->p_d_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('pDTSPAudioCreates.show', [$pDTSPAudioCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>