<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTopicSectionDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Project Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
    
    <tbody>
      
      @foreach($projectTopicSectionDeletes as $projectTopicSectionDelete)
          
        <tr>
              
          <td>{!! $projectTopicSectionDelete->datetime !!}</td>
          <td>{!! $projectTopicSectionDelete->user_id !!}</td>
          <td>{!! $projectTopicSectionDelete->project_topic_section_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
            
              <a href="{!! route('projectTopicSectionDeletes.show', [$projectTopicSectionDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>