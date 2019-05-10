<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTopics-filtered_table">
    
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
      
      @foreach($userProjectTopics as $userProjectTopic)
      
        <tr>
              
          <td> {!! $userProjectTopic->name !!} </td>
          <td> {!! $userProjectTopic->email !!} </td>
          <td> {!! $userProjectTopic->description !!} </td>
          <td> {!! $userProjectTopic->permissions !!}</td>
          <td> {!! $userProjectTopic->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userProjectTopics.destroy', $userProjectTopic->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userProjectTopics.edit', [$userProjectTopic->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>