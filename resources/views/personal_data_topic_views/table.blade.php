<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTopicViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal Data Topic Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTopicViews as $personalDataTopicView)
          
        <tr>
              
          <td>{!! $personalDataTopicView->datetime !!}</td>
          <td>{!! $personalDataTopicView->user_id !!}</td>
          <td>{!! $personalDataTopicView->personal_data_topic_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('personalDataTopicViews.show', [$personalDataTopicView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>