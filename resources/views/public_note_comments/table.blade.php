<table class="table table-responsive" id="publicNoteComments-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Public Note Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicNoteComments as $publicNoteComment)
        
      <tr>
            
        <td>{!! $publicNoteComment->content !!}</td>
        <td>{!! $publicNoteComment->status !!}</td>
        <td>{!! $publicNoteComment->datetime !!}</td>
        <td>{!! $publicNoteComment->public_note_id !!}</td>
        <td>{!! $publicNoteComment->user_id !!}</td>
            
        <td>
          
          {!! Form::open(['route' => ['publicNoteComments.destroy', $publicNoteComment->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicNoteComments.show', [$publicNoteComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicNoteComments.edit', [$publicNoteComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>