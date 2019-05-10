<table class="table table-responsive" id="publicFileLikes-table">
    
  <thead>
    
    <tr>
            
      <th>Status</th>
      <th>Datetime</th>
      <th>Public File Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicFileLikes as $publicFileLike)
        
      <tr>
            
        <td>{!! $publicFileLike->status !!}</td>
        <td>{!! $publicFileLike->datetime !!}</td>
        <td>{!! $publicFileLike->public_file_id !!}</td>
        <td>{!! $publicFileLike->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicFileLikes.destroy', $publicFileLike->id], 'method' => 'delete']) !!}
            
            <div class='btn-group'>
                    
              <a href="{!! route('publicFileLikes.show', [$publicFileLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicFileLikes.edit', [$publicFileLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>