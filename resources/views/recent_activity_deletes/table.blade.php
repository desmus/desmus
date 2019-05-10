<table class="table table-responsive" id="recentActivityDeletes-table">
    
  <thead>
        
    <tr>
            
      <th>Datetime</th>
      <th>User Id</th>
      <th>Recent Activity Id</th>
      <th colspan="3">Action</th>
    
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($recentActivityDeletes as $recentActivityDelete)
        
      <tr>
            
        <td>{!! $recentActivityDelete->datetime !!}</td>
        <td>{!! $recentActivityDelete->user_id !!}</td>
        <td>{!! $recentActivityDelete->recent_activity_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['recentActivityDeletes.destroy', $recentActivityDelete->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('recentActivityDeletes.show', [$recentActivityDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('recentActivityDeletes.edit', [$recentActivityDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>