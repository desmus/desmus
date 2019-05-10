<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTopicUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal Data Topic Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTopicUpdates as $personalDataTopicUpdate)
          
        <tr>
              
          <td>{!! $personalDataTopicUpdate->actual_name !!}</td>
          <td>{!! $personalDataTopicUpdate->past_name !!}</td>
          <td>{!! $personalDataTopicUpdate->datetime !!}</td>
          <td>{!! $personalDataTopicUpdate->user_id !!}</td>
          <td>{!! $personalDataTopicUpdate->personal_data_topic_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTopicUpdates.show', [$personalDataTopicUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>