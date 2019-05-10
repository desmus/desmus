<div class="table-responsive" style="margin-bottom: 0">

  <table class="table table-bordered table-striped dataTable" id="userJobTopics-filtered_table" style="margin-bottom: 0">
    
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
      
      @foreach($userJobTopics as $userJobTopic)
      
        <tr>
              
          <td> {!! $userJobTopic->name !!} </td>
          <td> {!! $userJobTopic->email !!} </td>
          <td> {!! $userJobTopic->description !!} </td>
          <td> {!! $userJobTopic->permissions !!}</td>
          <td> {!! $userJobTopic->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userJobTopics.destroy', $userJobTopic->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userJobTopics.edit', [$userJobTopic->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>