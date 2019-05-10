<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTopicSectionUs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User J T S Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTopicSectionUs as $userJobTopicSectionU)
          
        <tr>
              
          <td>{!! $userJobTopicSectionU->datetime !!}</td>
          <td>{!! $userJobTopicSectionU->user_id !!}</td>
          <td>{!! $userJobTopicSectionU->user_j_t_s_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTopicSectionUs.show', [$userJobTopicSectionU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>

</div>