<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userColleges-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>College Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userColleges as $userCollege)
          
        <tr>
              
          <td>{!! $userCollege->datetime !!}</td>
          <td>{!! $userCollege->description !!}</td>
          <td>{!! $userCollege->status !!}</td>
          <td>{!! $userCollege->permissions !!}</td>
          <td>{!! $userCollege->user_id !!}</td>
          <td>{!! $userCollege->college_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('userColleges.show', [$userCollege->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>