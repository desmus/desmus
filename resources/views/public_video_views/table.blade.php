<table class="table table-responsive" id="publicVideoViews-table">
    
  <thead>
        
    <tr>
            
      <th>Datetime</th>
      <th>User Id</th>
      <th>Public Video Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicVideoViews as $publicVideoView)
        
      <tr>
            
        <td>{!! $publicVideoView->datetime !!}</td>
        <td>{!! $publicVideoView->user_id !!}</td>
        <td>{!! $publicVideoView->public_video_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicVideoViews.destroy', $publicVideoView->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicVideoViews.show', [$publicVideoView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicVideoViews.edit', [$publicVideoView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>