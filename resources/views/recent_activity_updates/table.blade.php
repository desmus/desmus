<table class="table table-responsive" id="recentActivityUpdates-table">
    
  <thead>
        
    <tr>
            
      <th>Datetime</th>
      <th>User Id</th>
      <th>Recent Activity Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($recentActivityUpdates as $recentActivityUpdate)
        
      <tr>
            
        <td>{!! $recentActivityUpdate->datetime !!}</td>
        <td>{!! $recentActivityUpdate->user_id !!}</td>
        <td>{!! $recentActivityUpdate->recent_activity_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['recentActivityUpdates.destroy', $recentActivityUpdate->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('recentActivityUpdates.show', [$recentActivityUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('recentActivityUpdates.edit', [$recentActivityUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>