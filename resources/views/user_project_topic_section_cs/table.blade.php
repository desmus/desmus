<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTopicSectionCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User P T S Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTopicSectionCs as $userProjectTopicSectionC)
          
        <tr>
              
          <td>{!! $userProjectTopicSectionC->datetime !!}</td>
          <td>{!! $userProjectTopicSectionC->user_id !!}</td>
          <td>{!! $userProjectTopicSectionC->user_p_t_s_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectTopicSectionCs.show', [$userProjectTopicSectionC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>