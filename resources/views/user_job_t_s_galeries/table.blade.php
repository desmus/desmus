<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobTSGaleries-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Job T S Galery Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobTSGaleries as $userJobTSGalerie)
          
        <tr>
              
          <td>{!! $userJobTSGalerie->datetime !!}</td>
          <td>{!! $userJobTSGalerie->description !!}</td>
          <td>{!! $userJobTSGalerie->status !!}</td>
          <td>{!! $userJobTSGalerie->permissions !!}</td>
          <td>{!! $userJobTSGalerie->user_id !!}</td>
          <td>{!! $userJobTSGalerie->job_t_s_galery_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobTSGaleries.show', [$userJobTSGalerie->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>