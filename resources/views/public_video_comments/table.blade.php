<table class="table table-responsive" id="publicVideoComments-table">
    
  <thead>
        
    <tr>
            
      <th>Content</th>
      <th>Status</th>
      <th>Datetime</th>
      <th>Public Video Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicVideoComments as $publicVideoComment)
        
      <tr>
            
        <td>{!! $publicVideoComment->content !!}</td>
        <td>{!! $publicVideoComment->status !!}</td>
        <td>{!! $publicVideoComment->datetime !!}</td>
        <td>{!! $publicVideoComment->public_video_id !!}</td>
        <td>{!! $publicVideoComment->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicVideoComments.destroy', $publicVideoComment->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicVideoComments.show', [$publicVideoComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicVideoComments.edit', [$publicVideoComment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
      
      </tr>
    
    @endforeach
    
  </tbody>

</table>