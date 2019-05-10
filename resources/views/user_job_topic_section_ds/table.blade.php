<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTopicSectionDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User J T S Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTopicSectionDs as $userJobTopicSectionD)
          
        <tr>
              
          <td>{!! $userJobTopicSectionD->datetime !!}</td>
          <td>{!! $userJobTopicSectionD->user_id !!}</td>
          <td>{!! $userJobTopicSectionD->user_j_t_s_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTopicSectionDs.show', [$userJobTopicSectionD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>