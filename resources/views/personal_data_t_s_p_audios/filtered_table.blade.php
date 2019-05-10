<table class="table table-hover table-bordered table-striped dataTable" id="personalDataTSPAudios-filtered_table" style="margin-bottom: 0;">
  
  <thead>
        
    <tr>
            
      <th>Name</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($personalDataTSPAudios as $personalDataTSPAudio)
    
      <tr>
            
        <td> <a href = "{!! route('personalDataTSPAudios.show', [$personalDataTSPAudio->id]) !!}"> {!! $personalDataTSPAudio->name !!} </a> </td>
            
        <td>
          
          <div class='btn-group'>
                    
            <a href="{!! route('personalDataTSPAudios.show', [$personalDataTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="{!! route('personalDataTSPAudios.edit', [$personalDataTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
            <a href="{!! route('userPDTSPAudios.show', [$personalDataTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-share"></i></a>
            <a href ="{!! route('personalDataTSPAudios.destroy', [$personalDataTSPAudio->id]) !!}" onclick = "return confirm('Are you sure?')"class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i> </a>
              
          </div>
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>