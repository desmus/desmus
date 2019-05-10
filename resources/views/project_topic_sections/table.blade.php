<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTopicSections-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>User</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTopicSections as $projectTopicSection)
          
        <tr>
              
          <td>{!! $projectTopicSection->name !!}</td>
          <td>{!! $projectTopicSection->project_topic_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectTopicSections.show', [$projectTopicSection->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>

</div>