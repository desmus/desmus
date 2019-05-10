<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTSGaleryImageUs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User C T S G I Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTSGaleryImageUs as $userCollegeTSGaleryImageU)
          
        <tr>
              
          <td>{!! $userCollegeTSGaleryImageU->datetime !!}</td>
          <td>{!! $userCollegeTSGaleryImageU->user_id !!}</td>
          <td>{!! $userCollegeTSGaleryImageU->user_c_t_s_g_i_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userCollegeTSGaleryImageUs.show', [$userCollegeTSGaleryImageU->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>