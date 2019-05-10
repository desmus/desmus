<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTopicSections-filtered_table">
    
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
      
      @foreach($userProjectTopicSections as $userProjectTopicSection)
      
        <tr>
              
          <td> {!! $userProjectTopicSection->name !!} </td>
          <td> {!! $userProjectTopicSection->email !!} </td>
          <td> {!! $userProjectTopicSection->description !!} </td>
          <td> {!! $userProjectTopicSection->permissions !!}</td>
          <td> {!! $userProjectTopicSection->datetime !!} </td>
          
          <td>
                  
            {!! Form::open(['route' => ['userProjectTopicSections.destroy', $userProjectTopicSection->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userProjectTopicSections.edit', [$userProjectTopicSection->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>