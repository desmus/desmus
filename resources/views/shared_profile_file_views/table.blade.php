<table class="table table-responsive" id="sharedProfileFileViews-table">
    
  <thead>
        
    <tr>
            
      <th>Datetime</th>
      <th>User Id</th>
      <th>Public File Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileFileViews as $sharedProfileFileView)
        
      <tr>
            
        <td>{!! $sharedProfileFileView->datetime !!}</td>
        <td>{!! $sharedProfileFileView->user_id !!}</td>
        <td>{!! $sharedProfileFileView->shared_profile_file_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileFileViews.destroy', $sharedProfileFileView->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileFileViews.show', [$sharedProfileFileView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileFileViews.edit', [$sharedProfileFileView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>