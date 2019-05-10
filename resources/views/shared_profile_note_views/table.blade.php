<table class="table table-responsive" id="sharedProfileNoteViews-table">
    
  <thead>
        
    <tr>
            
      <th>Datetime</th>
      <th>User Id</th>
      <th>Shared Profile Note Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileNoteViews as $sharedProfileNoteView)
        
      <tr>
            
        <td>{!! $sharedProfileNoteView->datetime !!}</td>
        <td>{!! $sharedProfileNoteView->user_id !!}</td>
        <td>{!! $sharedProfileNoteView->shared_profile_note_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileNoteViews.destroy', $sharedProfileNoteView->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileNoteViews.show', [$sharedProfileNoteView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileNoteViews.edit', [$sharedProfileNoteView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>