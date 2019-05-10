<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="jobTSPAudios-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>File Type</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>J T S P Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($jobTSPAudios as $jobTSPAudio)
          
        <tr>
              
          <td>{!! $jobTSPAudio->name !!}</td>
          <td>{!! $jobTSPAudio->description !!}</td>
          <td>{!! $jobTSPAudio->file_type !!}</td>
          <td>{!! $jobTSPAudio->views_quantity !!}</td>
          <td>{!! $jobTSPAudio->updates_quantity !!}</td>
          <td>{!! $jobTSPAudio->status !!}</td>
          <td>{!! $jobTSPAudio->j_t_s_p_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('jobTSPAudios.show', [$jobTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>