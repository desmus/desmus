<table class="table table-responsive" id="publicNoteLikes-table">
    
  <thead>
        
    <tr>
            
      <th>Status</th>
      <th>Datetime</th>
      <th>Public Note Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicNoteLikes as $publicNoteLike)
        
      <tr>
            
        <td>{!! $publicNoteLike->status !!}</td>
        <td>{!! $publicNoteLike->datetime !!}</td>
        <td>{!! $publicNoteLike->public_note_id !!}</td>
        <td>{!! $publicNoteLike->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicNoteLikes.destroy', $publicNoteLike->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicNoteLikes.show', [$publicNoteLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicNoteLikes.edit', [$publicNoteLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>
  
</table>