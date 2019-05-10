<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTSFileCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User C T S F Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTSFileCs as $userCollegeTSFileC)
          
        <tr>
              
          <td>{!! $userCollegeTSFileC->datetime !!}</td>
          <td>{!! $userCollegeTSFileC->user_id !!}</td>
          <td>{!! $userCollegeTSFileC->user_c_t_s_f_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('userCollegeTSFileCs.show', [$userCollegeTSFileC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>