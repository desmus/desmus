<table class="table table-responsive" id="publicNotes-table">
    
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
    
    @foreach($publicNotes as $publicNote)
        
      <tr>
            
        <td>{!! $publicNote->name !!}</td>
        <td>{!! $publicNote->description !!}</td>
        <td>{!! $publicNote->content !!}</td>
        <td>{!! $publicNote->size !!}</td>
        <td>{!! $publicNote->views_quantity !!}</td>
        <td>{!! $publicNote->updates_quantity !!}</td>
        <td>{!! $publicNote->status !!}</td>
        <td>{!! $publicNote->datetime !!}</td>
        <td>{!! $publicNote->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicNotes.destroy', $publicNote->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicNotes.show', [$publicNote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicNotes.edit', [$publicNote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
  
  </tbody>

</table>