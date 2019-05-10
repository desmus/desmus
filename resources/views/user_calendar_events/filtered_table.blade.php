<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCalendarEvents-filtered_table" style="margin-bottom: 0;">
    
    <thead>
          
      <tr>
              
        <th>Username</th>
        <th>Email</th>
        <th>Description</th>
        <th>Permissions</th>
        <th>Datetime</th>
        <th>Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCalendarEvents as $userCalendarEvent)
      
        <tr>
              
          <td> {!! $userCalendarEvent->name !!} </td>
          <td> {!! $userCalendarEvent->email !!} </td>
          <td> {!! $userCalendarEvent->description !!} </td>
          <td> {!! $userCalendarEvent->permissions !!}</td>
          <td> {!! $userCalendarEvent->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userCalendarEvents.destroy', $userCalendarEvent->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userCalendarEvents.edit', [$userCalendarEvent->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>