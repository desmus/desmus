<table class="table table-responsive" id="userCalendarEventUpdates-table">
    
  <thead>
        
    <tr>
            
      <th>Datetime</th>
      <th>User Id</th>
      <th>User C E Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($userCalendarEventUpdates as $userCalendarEventUpdate)
        
      <tr>
            
        <td>{!! $userCalendarEventUpdate->datetime !!}</td>
        <td>{!! $userCalendarEventUpdate->user_id !!}</td>
        <td>{!! $userCalendarEventUpdate->user_c_e_id !!}</td>
            
        <td>
                
          {!! Form::open(['route' => ['userCalendarEventUpdates.destroy', $userCalendarEventUpdate->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('userCalendarEventUpdates.show', [$userCalendarEventUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('userCalendarEventUpdates.edit', [$userCalendarEventUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>