<table class="table table-hover table-bordered table-striped dataTable" id="jobTSPAudios-filtered_table" style="margin-bottom: 0;">
  
  <thead>
        
    <tr>
            
      <th>Name</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($jobTSPAudios as $jobTSPAudio)
    
      <tr>
            
        <td> <a href = "{!! route('jobTSPAudios.show', [$jobTSPAudio->id]) !!}"> {!! $jobTSPAudio->name !!} </a> </td>
            
        <td>
                
          <div class='btn-group'>
            
            <a href="{!! route('jobTSPAudios.show', [$jobTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="{!! route('jobTSPAudios.edit', [$jobTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
            <a href="{!! route('userJobTSPAudios.show', [$jobTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-share"></i></a>
            <a href ="{!! route('jobTSPAudios.destroy', [$jobTSPAudio->id]) !!}" onclick = "return confirm('Are you sure?')"class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i> </a>
            
            </div>
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>