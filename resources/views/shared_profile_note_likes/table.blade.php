<table class="table table-responsive" id="sharedProfileNoteLikes-table">
    
  <thead>
        
    <tr>
            
      <th>Status</th>
      <th>Datetime</th>
      <th>Shared Profile Note Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileNoteLikes as $sharedProfileNoteLike)
        
      <tr>
            
        <td>{!! $sharedProfileNoteLike->status !!}</td>
        <td>{!! $sharedProfileNoteLike->datetime !!}</td>
        <td>{!! $sharedProfileNoteLike->shared_profile_note_id !!}</td>
        <td>{!! $sharedProfileNoteLike->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileNoteLikes.destroy', $sharedProfileNoteLike->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileNoteLikes.show', [$sharedProfileNoteLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileNoteLikes.edit', [$sharedProfileNoteLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>
  
</table>