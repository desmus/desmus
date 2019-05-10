<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTopicSectionCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User J T S Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTopicSectionCs as $userJobTopicSectionC)
          
        <tr>
              
          <td>{!! $userJobTopicSectionC->datetime !!}</td>
          <td>{!! $userJobTopicSectionC->user_id !!}</td>
          <td>{!! $userJobTopicSectionC->user_j_t_s_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTopicSectionCs.show', [$userJobTopicSectionC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>