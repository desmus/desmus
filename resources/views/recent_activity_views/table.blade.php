<table class="table table-responsive" id="recentActivityViews-table">
    
  <thead>
        
    <tr>
            
      <th>Datetime</th>
      <th>User Id</th>
      <th>Recent Activity Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($recentActivityViews as $recentActivityView)
        
      <tr>
            
        <td>{!! $recentActivityView->datetime !!}</td>
        <td>{!! $recentActivityView->user_id !!}</td>
        <td>{!! $recentActivityView->recent_activity_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['recentActivityViews.destroy', $recentActivityView->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('recentActivityViews.show', [$recentActivityView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('recentActivityViews.edit', [$recentActivityView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>