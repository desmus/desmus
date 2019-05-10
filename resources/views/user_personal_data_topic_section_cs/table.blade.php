<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTopicSectionCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D T S Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTopicSectionCs as $userPersonalDataTopicSectionC)
          
        <tr>
              
          <td>{!! $userPersonalDataTopicSectionC->datetime !!}</td>
          <td>{!! $userPersonalDataTopicSectionC->user_id !!}</td>
          <td>{!! $userPersonalDataTopicSectionC->u_p_d_t_s_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTopicSectionCs.show', [$userPersonalDataTopicSectionC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>