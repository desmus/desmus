<table class="table table-responsive" id="publicVideoUpdates-table">
    
  <thead>
        
    <tr>
            
      <th>Actual Name</th>
      <th>Past Name</th>
      <th>Datetime</th>
      <th>User Id</th>
      <th>Public Video Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($publicVideoUpdates as $publicVideoUpdate)
        
      <tr>
            
        <td>{!! $publicVideoUpdate->actual_name !!}</td>
        <td>{!! $publicVideoUpdate->past_name !!}</td>
        <td>{!! $publicVideoUpdate->datetime !!}</td>
        <td>{!! $publicVideoUpdate->user_id !!}</td>
        <td>{!! $publicVideoUpdate->public_video_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['publicVideoUpdates.destroy', $publicVideoUpdate->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('publicVideoUpdates.show', [$publicVideoUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('publicVideoUpdates.edit', [$publicVideoUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
          
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>