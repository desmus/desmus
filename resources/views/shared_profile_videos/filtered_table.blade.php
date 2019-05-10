<table class="table table-hover table-bordered table-striped dataTable" id="sharedProfileVideos-filtered_table">
  
  <thead>
        
    <tr>
            
      <th>Name</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileVideos as $sharedProfileVideo)
    
      <tr>
            
        <td> <a href = "{!! route('sharedProfileVideos.show', [$sharedProfileVideo->id]) !!}"> {!! $sharedProfileVideo->name !!} </a> </td>
            
        <td>
                
          <div class='btn-group'>
            
            <a href="{!! route('sharedProfileVideos.show', [$sharedProfileVideo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="{!! route('sharedProfileVideos.edit', [$sharedProfileVideo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
            <a href ="{!! route('sharedProfileVideos.destroy', [$sharedProfileVideo->id]) !!}" onclick = "return confirm('Are you sure?')"class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i> </a>
            
          </div>
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>