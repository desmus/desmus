<table class="table table-responsive" id="publicVideoLikes-table">
    
  <thead>
        
    <tr>
            
      <th>Status</th>
      <th>Datetime</th>
      <th>Public Video Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicVideoLikes as $publicVideoLike)
        
      <tr>
            
        <td>{!! $publicVideoLike->status !!}</td>
        <td>{!! $publicVideoLike->datetime !!}</td>
        <td>{!! $publicVideoLike->public_video_id !!}</td>
        <td>{!! $publicVideoLike->user_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicVideoLikes.destroy', $publicVideoLike->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicVideoLikes.show', [$publicVideoLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicVideoLikes.edit', [$publicVideoLike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>