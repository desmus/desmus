<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTopicDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>U P D T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTopicDs as $userPersonalDataTopicD)
          
        <tr>
              
          <td>{!! $userPersonalDataTopicD->datetime !!}</td>
          <td>{!! $userPersonalDataTopicD->user_id !!}</td>
          <td>{!! $userPersonalDataTopicD->u_p_d_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('userPersonalDataTopicDs.show', [$userPersonalDataTopicD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>