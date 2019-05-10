<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSPAudioCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSPAudioCreates as $projectTSPAudioCreate)
          
        <tr>
              
          <td>{!! $projectTSPAudioCreate->datetime !!}</td>
          <td>{!! $projectTSPAudioCreate->user_id !!}</td>
          <td>{!! $projectTSPAudioCreate->p_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('projectTSPAudioCreates.show', [$projectTSPAudioCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>