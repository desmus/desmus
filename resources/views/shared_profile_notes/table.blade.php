<table class="table table-responsive" id="sharedProfileNotes-table">
    
  <thead>
        
    <tr>
            
      <th>Name</th>
      <th>Description</th>
      <th>Content</th>
      <th>Size</th>
      <th>Views Quantity</th>
      <th>Updates Quantity</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileNotes as $sharedProfileNote)
        
      <tr>
            
        <td>{!! $sharedProfileNote->name !!}</td>
        <td>{!! $sharedProfileNote->description !!}</td>
        <td>{!! $sharedProfileNote->content !!}</td>
        <td>{!! $sharedProfileNote->size !!}</td>
        <td>{!! $sharedProfileNote->views_quantity !!}</td>
        <td>{!! $sharedProfileNote->updates_quantity !!}</td>
        <td>{!! $sharedProfileNote->status !!}</td>
        <td>{!! $sharedProfileNote->datetime !!}</td>
        <td>{!! $sharedProfileNote->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileNotes.destroy', $sharedProfileNote->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileNotes.show', [$sharedProfileNote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileNotes.edit', [$sharedProfileNote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
  
  </tbody>

</table>