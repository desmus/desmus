<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTopicSections-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>College Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTopicSections as $userCollegeTopicSection)
          
        <tr>
              
          <td>{!! $userCollegeTopicSection->datetime !!}</td>
          <td>{!! $userCollegeTopicSection->description !!}</td>
          <td>{!! $userCollegeTopicSection->status !!}</td>
          <td>{!! $userCollegeTopicSection->permissions !!}</td>
          <td>{!! $userCollegeTopicSection->user_id !!}</td>
          <td>{!! $userCollegeTopicSection->college_topic_section_id !!}</td>
              
          <td>
                  
            {!! Form::open(['route' => ['userCollegeTopicSections.destroy', $userCollegeTopicSection->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userCollegeTopicSections.show', [$userCollegeTopicSection->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
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