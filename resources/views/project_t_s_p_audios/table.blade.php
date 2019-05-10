<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSPAudios-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>File Type</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>C T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSPAudios as $projectTSPAudio)
          
        <tr>
              
          <td>{!! $projectTSPAudio->name !!}</td>
          <td>{!! $projectTSPAudio->description !!}</td>
          <td>{!! $projectTSPAudio->file_type !!}</td>
          <td>{!! $projectTSPAudio->views_quantity !!}</td>
          <td>{!! $projectTSPAudio->updates_quantity !!}</td>
          <td>{!! $projectTSPAudio->status !!}</td>
          <td>{!! $projectTSPAudio->p_t_s_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('projectTSPAudios.show', [$projectTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>