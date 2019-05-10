<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTopicSections-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>User</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTopicSections as $collegeTopicSection)
          
        <tr>
              
          <td>{!! $collegeTopicSection->name !!}</td>
          <td>{!! $collegeTopicSection->college_topic_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTopicSections.show', [$collegeTopicSection->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>

</div>