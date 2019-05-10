<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTopicSectionTodolistCreates-table">
    
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTopicSectionTodolistCreates as $collegeTopicSectionTodolistCreate)
          
        <tr>
              
          <td>{!! $collegeTopicSectionTodolistCreate->datetime !!}</td>
          <td>{!! $collegeTopicSectionTodolistCreate->user_id !!}</td>
          <td>{!! $collegeTopicSectionTodolistCreate->c_t_s_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
            
              <a href="{!! route('collegeTSTodolistCreates.show', [$collegeTopicSectionTodolistCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>