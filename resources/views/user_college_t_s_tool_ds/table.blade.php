<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTSToolDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User C T S T Id</th>
        <th colspan="3">Action</th>
          
      </tr>
    
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTSToolDs as $userCollegeTSToolD)
          
        <tr>
              
          <td>{!! $userCollegeTSToolD->datetime !!}</td>
          <td>{!! $userCollegeTSToolD->user_id !!}</td>
          <td>{!! $userCollegeTSToolD->user_c_t_s_t_id !!}</td>
            
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userCollegeTSToolDs.show', [$userCollegeTSToolD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>