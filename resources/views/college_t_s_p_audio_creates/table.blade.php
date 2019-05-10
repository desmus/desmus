<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSPAudioCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S P A Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSPAudioCreates as $collegeTSPAudioCreate)
          
        <tr>
              
          <td>{!! $collegeTSPAudioCreate->datetime !!}</td>
          <td>{!! $collegeTSPAudioCreate->user_id !!}</td>
          <td>{!! $collegeTSPAudioCreate->c_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTSPAudioCreates.show', [$collegeTSPAudioCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>