<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTopicSectionDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>College Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
    
    <tbody>
      
      @foreach($collegeTopicSectionDeletes as $collegeTopicSectionDelete)
          
        <tr>
              
          <td>{!! $collegeTopicSectionDelete->datetime !!}</td>
          <td>{!! $collegeTopicSectionDelete->user_id !!}</td>
          <td>{!! $collegeTopicSectionDelete->college_topic_section_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
            
              <a href="{!! route('collegeTopicSectionDeletes.show', [$collegeTopicSectionDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>