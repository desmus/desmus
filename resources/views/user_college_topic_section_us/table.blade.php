<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTopicSectionUs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User C T S Id</th>
        <th colspan="3">Action</th>
         
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTopicSectionUs as $userCollegeTopicSectionU)
          
        <tr>
              
          <td>{!! $userCollegeTopicSectionU->datetime !!}</td>
          <td>{!! $userCollegeTopicSectionU->user_id !!}</td>
          <td>{!! $userCollegeTopicSectionU->user_c_t_s_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userCollegeTopicSectionUs.show', [$userCollegeTopicSectionU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>