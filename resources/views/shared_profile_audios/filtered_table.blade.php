<table class="table table-hover table-bordered table-striped dataTable" id="sharedProfileAudios-filtered_table">
  
  <thead>
        
    <tr>
            
      <th>Name</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileAudios as $sharedProfileAudio)
    
      <tr>
            
        <td> <a href = "{!! route('sharedProfileAudios.show', [$sharedProfileAudio->id]) !!}"> {!! $sharedProfileAudio->name !!} </a> </td>
            
        <td>
                
          <div class='btn-group'>
            
            <a href="{!! route('sharedProfileAudios.show', [$sharedProfileAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="{!! route('sharedProfileAudios.edit', [$sharedProfileAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
            <a href ="{!! route('sharedProfileAudios.destroy', [$sharedProfileAudio->id]) !!}" onclick = "return confirm('Are you sure?')"class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i> </a>
            
          </div>
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>