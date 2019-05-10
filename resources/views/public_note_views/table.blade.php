<table class="table table-responsive" id="publicNoteViews-table">
    
  <thead>
        
    <tr>
            
      <th>Datetime</th>
      <th>User Id</th>
      <th>Public Note Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicNoteViews as $publicNoteView)
        
      <tr>
            
        <td>{!! $publicNoteView->datetime !!}</td>
        <td>{!! $publicNoteView->user_id !!}</td>
        <td>{!! $publicNoteView->public_note_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicNoteViews.destroy', $publicNoteView->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicNoteViews.show', [$publicNoteView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicNoteViews.edit', [$publicNoteView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>