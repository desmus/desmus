<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTopicCreates-table">
      
    <thead>
      
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>College Topic Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTopicCreates as $collegeTopicCreate)
          
        <tr>
              
          <td>{!! $collegeTopicCreate->datetime !!}</td>
          <td>{!! $collegeTopicCreate->user_id !!}</td>
          <td>{!! $collegeTopicCreate->college_topic_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTopicCreates.show', [$collegeTopicCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>