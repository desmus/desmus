<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSPAudioViews-table">
      
    <thead>
      
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>P T S P A Id</th>
        <th colspan="3">Action</th>
      
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSPAudioViews as $projectTSPAudioView)
          
        <tr>
              
          <td>{!! $projectTSPAudioView->datetime !!}</td>
          <td>{!! $projectTSPAudioView->user_id !!}</td>
          <td>{!! $projectTSPAudioView->p_t_s_p_a_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSPAudioViews.show', [$projectTSPAudioView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>