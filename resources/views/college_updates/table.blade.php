<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Actual Name</th>
        <th>Past Name</th>
        <th>Datetime</th>
        <th>User Id</th>
        <th>College Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeUpdates as $collegeUpdate)
          
        <tr>
              
          <td>{!! $collegeUpdate->actual_name !!}</td>
          <td>{!! $collegeUpdate->past_name !!}</td>
          <td>{!! $collegeUpdate->datetime !!}</td>
          <td>{!! $collegeUpdate->user_id !!}</td>
          <td>{!! $collegeUpdate->college_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeUpdates.show', [$collegeUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>