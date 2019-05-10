<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTSToolFileCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User C T S T F Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTSToolFileCs as $userCollegeTSToolFileC)
          
        <tr>
              
          <td>{!! $userCollegeTSToolFileC->datetime !!}</td>
          <td>{!! $userCollegeTSToolFileC->user_id !!}</td>
          <td>{!! $userCollegeTSToolFileC->user_c_t_s_t_f_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('userCollegeTSToolFileCs.show', [$userCollegeTSToolFileC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>