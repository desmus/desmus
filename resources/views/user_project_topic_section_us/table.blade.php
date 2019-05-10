<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTopicSectionUs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User P T S Id</th>
        <th colspan="3">Action</th>
         
      </tr>
      
    </thead>
      
    <tbody>
     
      @foreach($userProjectTopicSectionUs as $userProjectTopicSectionU)
          
        <tr>
              
          <td>{!! $userProjectTopicSectionU->datetime !!}</td>
          <td>{!! $userProjectTopicSectionU->user_id !!}</td>
          <td>{!! $userProjectTopicSectionU->user_p_t_s_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectTopicSectionUs.show', [$userProjectTopicSectionU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>