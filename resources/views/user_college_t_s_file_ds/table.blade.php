<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTSFileDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User C T S F Id</th>
        <th colspan="3">Action</th>
      
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTSFileDs as $userCollegeTSFileD)
          
        <tr>
              
          <td>{!! $userCollegeTSFileD->datetime !!}</td>
          <td>{!! $userCollegeTSFileD->user_id !!}</td>
          <td>{!! $userCollegeTSFileD->user_c_t_s_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userCollegeTSFileDs.show', [$userCollegeTSFileD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>