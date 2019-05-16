<table class="table table-responsive" id="sharedProfileVideoComments-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Shared Profile Video Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($sharedProfileVideoCs as $sharedProfileVideoC)
        
      <tr>
            
        <td>{!! $sharedProfileVideoC->content !!}</td>
        <td>{!! $sharedProfileVideoC->status !!}</td>
        <td>{!! $sharedProfileVideoC->datetime !!}</td>
        <td>{!! $sharedProfileVideoC->shared_profile_video_id !!}</td>
        <td>{!! $sharedProfileVideoC->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['sharedProfileVideoCs.destroy', $sharedProfileVideoC->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('sharedProfileVideoCs.show', [$sharedProfileVideoC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('sharedProfileVideoCs.edit', [$sharedProfileVideoC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
      
      </tr>
    
    @endforeach
    
  </tbody>

</table>