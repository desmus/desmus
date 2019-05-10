<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User C Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeDs as $userCollegeD)
          
        <tr>
              
          <td>{!! $userCollegeD->datetime !!}</td>
          <td>{!! $userCollegeD->user_id !!}</td>
          <td>{!! $userCollegeD->user_c_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userCollegeDs.show', [$userCollegeD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>