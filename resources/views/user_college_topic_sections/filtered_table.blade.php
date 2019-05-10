<div class="table-responsive" style="margin-bottom: 0;">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTopicSections-filtered_table" style="margin-bottom: 0;">
    
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
      
      @foreach($userCollegeTopicSections as $userCollegeTopicSection)
      
        <tr>
              
          <td> {!! $userCollegeTopicSection->name !!} </td>
          <td> {!! $userCollegeTopicSection->email !!} </td>
          <td> {!! $userCollegeTopicSection->description !!} </td>
          <td> {!! $userCollegeTopicSection->permissions !!}</td>
          <td> {!! $userCollegeTopicSection->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userCollegeTopicSections.destroy', $userCollegeTopicSection->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userCollegeTopicSections.edit', [$userCollegeTopicSection->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>