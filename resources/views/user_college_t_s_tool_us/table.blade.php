<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTSToolUs-table">
    
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User C T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTSToolUs as $userCollegeTSToolU)
          
        <tr>
              
          <td>{!! $userCollegeTSToolU->datetime !!}</td>
          <td>{!! $userCollegeTSToolU->user_id !!}</td>
          <td>{!! $userCollegeTSToolU->user_c_t_s_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userCollegeTSToolUs.show', [$userCollegeTSToolU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>