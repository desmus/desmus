<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTSToolFileDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User C T S T F Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTSToolFileDs as $userCollegeTSToolFileD)
          
        <tr>
              
          <td>{!! $userCollegeTSToolFileD->datetime !!}</td>
          <td>{!! $userCollegeTSToolFileD->user_id !!}</td>
          <td>{!! $userCollegeTSToolFileD->user_c_t_s_t_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userCollegeTSToolFileDs.show', [$userCollegeTSToolFileD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>