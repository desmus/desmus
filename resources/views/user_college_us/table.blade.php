<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeUs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User C Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($userCollegeUs as $userCollegeU)
          
        <tr>
              
          <td>{!! $userCollegeU->datetime !!}</td>
          <td>{!! $userCollegeU->user_id !!}</td>
          <td>{!! $userCollegeU->user_c_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('userCollegeUs.show', [$userCollegeU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>