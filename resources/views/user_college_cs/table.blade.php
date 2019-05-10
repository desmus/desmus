<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User C Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeCs as $userCollegeC)
          
        <tr>
              
          <td>{!! $userCollegeC->datetime !!}</td>
          <td>{!! $userCollegeC->user_id !!}</td>
          <td>{!! $userCollegeC->user_c_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userCollegeCreates.show', [$userCollegeC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>