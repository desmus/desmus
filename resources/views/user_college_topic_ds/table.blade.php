<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTopicDs-table">
  
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User C T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTopicDs as $userCollegeTopicD)
          
        <tr>
              
          <td>{!! $userCollegeTopicD->datetime !!}</td>
          <td>{!! $userCollegeTopicD->user_id !!}</td>
          <td>{!! $userCollegeTopicD->user_c_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('userCollegeTopicDs.show', [$userCollegeTopicD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>