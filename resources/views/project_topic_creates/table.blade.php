<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTopicCreates-table">
      
    <thead>
      
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project Topic Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTopicCreates as $projectTopicCreate)
          
        <tr>
              
          <td>{!! $projectTopicCreate->datetime !!}</td>
          <td>{!! $projectTopicCreate->user_id !!}</td>
          <td>{!! $projectTopicCreate->project_topic_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectTopicCreates.show', [$projectTopicCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>