<table class="table table-hover table-bordered table-striped dataTable" id="publicFiles-filtered_table">
  
  <thead>
        
    <tr>
            
      <th>Name</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicFiles as $publicFile)
    
      <tr>
            
        <td> <a href = "{!! route('publicFiles.show', [$publicFile->id]) !!}"> {!! $publicFile->name !!} </a> </td>
            
        <td>
                
          {!! Form::open(['route' => ['publicFiles.destroy', $publicFile->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicFiles.show', [$publicFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicFiles.edit', [$publicFile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>