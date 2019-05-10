<table class="table table-hover table-bordered table-striped dataTable" id="collegeTSPAudios-filtered_table" style="margin-bottom: 0;">
  
  <thead>
        
    <tr>
            
      <th>Name</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($collegeTSPAudios as $collegeTSPAudio)
    
      <tr>
            
        <td> <a href = "{!! route('collegeTSPAudios.show', [$collegeTSPAudio->id]) !!}"> {!! $collegeTSPAudio->name !!} </a> </td>
            
        <td>
                
          <div class='btn-group'>
            
            <a href="{!! route('collegeTSPAudios.show', [$collegeTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="{!! route('collegeTSPAudios.edit', [$collegeTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
            <a href="{!! route('userCollegeTSPAudios.show', [$collegeTSPAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-share"></i></a>
            <a href ="{!! route('collegeTSPAudios.destroy', [$collegeTSPAudio->id]) !!}" onclick = "return confirm('Are you sure?')"class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i> </a>
            
            </div>
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>