<div class="table-responsive" style="margin-bottom: 0">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTopics-filtered_table" style="margin-bottom: 0">
    
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
      
      @foreach($userCollegeTopics as $userCollegeTopic)
      
        <tr>
              
          <td> {!! $userCollegeTopic->name !!} </td>
          <td> {!! $userCollegeTopic->email !!} </td>
          <td> {!! $userCollegeTopic->description !!} </td>
          <td> {!! $userCollegeTopic->permissions !!}</td>
          <td> {!! $userCollegeTopic->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userCollegeTopics.destroy', $userCollegeTopic->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userCollegeTopics.edit', [$userCollegeTopic->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>