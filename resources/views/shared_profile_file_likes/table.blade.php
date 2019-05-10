<table class="table table-responsive" id="sharedProfileFileLikes-table">
    
  <thead>
    
    <tr>
            
      <th>Status</th>
      <th>Datetime</th>
      <th>Shared Profile File Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileFileLikes as $sharedProfileFileLike)
        
      <tr>
            
        <td>{!! $sharedProfileFileLike->status !!}</td>
        <td>{!! $sharedProfileFileLike->datetime !!}</td>
        <td>{!! $sharedProfileFileLike->shared_profile_file_id !!}</td>
        <td>{!! $sharedProfileFileLike->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileFileLikes.destroy', $sharedProfileFileLike->id], 'method' => 'delete']) !!}
            
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileFileLikes.show', [$sharedProfileFileLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileFileLikes.edit', [$sharedProfileFileLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>