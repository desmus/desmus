<table class="table table-hover table-bordered table-striped dataTable" id="projectTSPAudios-filtered_table" style="margin-bottom: 0;">
  
  <thead>
        
    <tr>
            
      <th>Name</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($projectTSPAudios as $projectTSPAudio)
    
      <tr>
            
        <td> <a href = "{!! route('projectTSPAudios.show', [$projectTSPAudio->id]) !!}"> {!! $projectTSPAudio->name !!} </a> </td>
            
        <td>
                
          <div class='btn-group'>
            
            <a href="{!! route('projectTSPAudios.show', [$projectTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="{!! route('projectTSPAudios.edit', [$projectTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
            <a href="{!! route('userProjectTSPAudios.show', [$projectTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-share"></i></a>
            <a href ="{!! route('projectTSPAudios.destroy', [$projectTSPAudio->id]) !!}" onclick = "return confirm('Are you sure?')"class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i> </a>
            
            </div>
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>