<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTopicSectionUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal Data T S Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTopicSectionUpdates as $personalDataTopicSectionUpdate)
          
        <tr>
              
          <td>{!! $personalDataTopicSectionUpdate->actual_name !!}</td>
          <td>{!! $personalDataTopicSectionUpdate->past_name !!}</td>
          <td>{!! $personalDataTopicSectionUpdate->datetime !!}</td>
          <td>{!! $personalDataTopicSectionUpdate->user_id !!}</td>
          <td>{!! $personalDataTopicSectionUpdate->personal_data_t_s_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTopicSectionUpdates.show', [$personalDataTopicSectionUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>