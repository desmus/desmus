<table class="table table-responsive" id="publicNoteUpdates-table">
    
  <thead>
        
    <tr>
            
      <th>Actual Name</th>
      <th>Past Name</th>
      <th>Datetime</th>
      <th>User Id</th>
      <th>Public Note Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
  
    @foreach($publicNoteUpdates as $publicNoteUpdate)
        
      <tr>
            
        <td>{!! $publicNoteUpdate->actual_name !!}</td>
        <td>{!! $publicNoteUpdate->past_name !!}</td>
        <td>{!! $publicNoteUpdate->datetime !!}</td>
        <td>{!! $publicNoteUpdate->user_id !!}</td>
        <td>{!! $publicNoteUpdate->public_note_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicNoteUpdates.destroy', $publicNoteUpdate->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicNoteUpdates.show', [$publicNoteUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicNoteUpdates.edit', [$publicNoteUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
            
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>
  
</table>