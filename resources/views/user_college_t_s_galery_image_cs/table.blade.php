<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTSGaleryImageCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User C T S G I Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTSGaleryImageCs as $userCollegeTSGaleryImageC)
          
        <tr>
              
          <td>{!! $userCollegeTSGaleryImageC->datetime !!}</td>
          <td>{!! $userCollegeTSGaleryImageC->user_id !!}</td>
          <td>{!! $userCollegeTSGaleryImageC->user_c_t_s_g_i_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userCollegeTSGaleryImageCs.show', [$userCollegeTSGaleryImageC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>