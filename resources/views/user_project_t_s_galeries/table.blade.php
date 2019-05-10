<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userProjectTSGaleries-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Project T S Galery Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userProjectTSGaleries as $userProjectTSGalerie)
          
        <tr>
              
          <td>{!! $userProjectTSGalerie->datetime !!}</td>
          <td>{!! $userProjectTSGalerie->description !!}</td>
          <td>{!! $userProjectTSGalerie->status !!}</td>
          <td>{!! $userProjectTSGalerie->permissions !!}</td>
          <td>{!! $userProjectTSGalerie->user_id !!}</td>
          <td>{!! $userProjectTSGalerie->project_t_s_galery_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userProjectTSGaleries.show', [$userProjectTSGalerie->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>