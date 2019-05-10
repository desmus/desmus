<table class="table table-hover table-bordered table-striped dataTable" id="publicVideos-filtered_table">
  
  <thead>
        
    <tr>
            
      <th>Name</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicVideos as $publicVideo)
    
      <tr>
            
        <td> <a href = "{!! route('publicVideos.show', [$publicVideo->id]) !!}"> {!! $publicVideo->name !!} </a> </td>
            
        <td>
                
          <div class='btn-group'>
            
            <a href="{!! route('publicVideos.show', [$publicVideo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="{!! route('publicVideos.edit', [$publicVideo->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
            <a href ="{!! route('publicVideos.destroy', [$publicVideo->id]) !!}" onclick = "return confirm('Are you sure?')"class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-trash"></i> </a>
            
          </div>
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>