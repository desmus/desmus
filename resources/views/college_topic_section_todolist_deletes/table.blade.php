<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTopicSectionTodolistDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>C T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTopicSectionTodolistDeletes as $collegeTopicSectionTodolistDelete)
          
        <tr>
              
          <td>{!! $collegeTopicSectionTodolistDelete->datetime !!}</td>
          <td>{!! $collegeTopicSectionTodolistDelete->user_id !!}</td>
          <td>{!! $collegeTopicSectionTodolistDelete->c_t_s_t_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSTodolistDeletes.show', [$collegeTopicSectionTodolistDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
              
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>