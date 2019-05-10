<table class="table table-responsive" id="userCalendarEventCreates-table">
    
  <thead>
        
    <tr>
            
      <th>Datetime</th>
      <th>User Id</th>
      <th>User C E Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($userCalendarEventCreates as $userCalendarEventCreate)
        
      <tr>
            
        <td>{!! $userCalendarEventCreate->datetime !!}</td>
        <td>{!! $userCalendarEventCreate->user_id !!}</td>
        <td>{!! $userCalendarEventCreate->user_c_e_id !!}</td>
          
        <td>
                
          {!! Form::open(['route' => ['userCalendarEventCreates.destroy', $userCalendarEventCreate->id], 'method' => 'delete']) !!}
                
            <div class='btn-group'>
                    
              <a href="{!! route('userCalendarEventCreates.show', [$userCalendarEventCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('userCalendarEventCreates.edit', [$userCalendarEventCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
                
          {!! Form::close() !!}
            
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>