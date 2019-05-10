<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTSGaleries-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>College T S Galery Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userCollegeTSGaleries as $userCollegeTSGalerie)
          
        <tr>
              
          <td>{!! $userCollegeTSGalerie->datetime !!}</td>
          <td>{!! $userCollegeTSGalerie->description !!}</td>
          <td>{!! $userCollegeTSGalerie->status !!}</td>
          <td>{!! $userCollegeTSGalerie->permissions !!}</td>
          <td>{!! $userCollegeTSGalerie->user_id !!}</td>
          <td>{!! $userCollegeTSGalerie->college_t_s_galery_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userCollegeTSGaleries.show', [$userCollegeTSGalerie->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>