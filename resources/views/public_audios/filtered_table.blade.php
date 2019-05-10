<table class="table table-hover table-bordered table-striped dataTable" id="publicAudios-filtered_table">
  
  <thead>
        
    <tr>
            
      <th>Name</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicAudios as $publicAudio)
    
      <tr>
            
        <td> <a href = "{!! route('publicAudios.show', [$publicAudio->id]) !!}"> {!! $publicAudio->name !!} </a> </td>
            
        <td>
                
          <div class='btn-group'>
            
            <a href="{!! route('publicAudios.show', [$publicAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="{!! route('publicAudios.edit', [$publicAudio->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
            <a href ="{!! route('publicAudios.destroy', [$publicAudio->id]) !!}" onclick = "return confirm('Are you sure?')"class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i> </a>
            
          </div>
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>