<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTSToolCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User C T S T Id</th>
        <th colspan="3">Action</th>
      
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTSToolCs as $userCollegeTSToolC)
        
        <tr>
              
          <td>{!! $userCollegeTSToolC->datetime !!}</td>
          <td>{!! $userCollegeTSToolC->user_id !!}</td>
          <td>{!! $userCollegeTSToolC->user_c_t_s_t_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userCollegeTSToolCs.show', [$userCollegeTSToolC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>