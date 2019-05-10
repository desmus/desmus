<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTopicSections-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Job Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTopicSections as $userJobTopicSection)
          
        <tr>
              
          <td>{!! $userJobTopicSection->datetime !!}</td>
          <td>{!! $userJobTopicSection->description !!}</td>
          <td>{!! $userJobTopicSection->status !!}</td>
          <td>{!! $userJobTopicSection->permissions !!}</td>
          <td>{!! $userJobTopicSection->user_id !!}</td>
          <td>{!! $userJobTopicSection->job_topic_section_id !!}</td>
              
          <td>
                  
            {!! Form::open(['route' => ['userJobTopicSections.destroy', $userJobTopicSection->id], 'method' => 'delete']) !!}
                  
              <div class='btn-group'>
                      
                <a href="{!! route('userJobTopicSections.show', [$userJobTopicSection->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('userJobTopicSections.edit', [$userJobTopicSection->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  
              </div>
                  
            {!! Form::close() !!}
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>