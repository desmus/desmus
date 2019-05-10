<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTopicCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal Data Topic Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTopicCreates as $personalDataTopicCreate)
          
        <tr>
              
          <td>{!! $personalDataTopicCreate->datetime !!}</td>
          <td>{!! $personalDataTopicCreate->user_id !!}</td>
          <td>{!! $personalDataTopicCreate->personal_data_topic_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('personalDataTopicCreates.show', [$personalDataTopicCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>