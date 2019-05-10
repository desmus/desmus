<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTopicSections-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Project Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTopicSections as $userProjectTopicSection)
          
        <tr>
              
          <td>{!! $userProjectTopicSection->datetime !!}</td>
          <td>{!! $userProjectTopicSection->description !!}</td>
          <td>{!! $userProjectTopicSection->status !!}</td>
          <td>{!! $userProjectTopicSection->permissions !!}</td>
          <td>{!! $userProjectTopicSection->user_id !!}</td>
          <td>{!! $userProjectTopicSection->project_topic_section_id !!}</td>
              
          <td>
                  
            {!! Form::open(['route' => ['userProjectTopicSections.destroy', $userProjectTopicSection->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userProjectTopicSections.show', [$userProjectTopicSection->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
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