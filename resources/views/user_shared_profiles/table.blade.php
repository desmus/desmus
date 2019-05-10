<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userSharedProfiles-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Shared Profile Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userSharedProfiles as $userSharedProfile)
          
        <tr>
              
          <td>{!! $userSharedProfile->datetime !!}</td>
          <td>{!! $userSharedProfile->description !!}</td>
          <td>{!! $userSharedProfile->status !!}</td>
          <td>{!! $userSharedProfile->permissions !!}</td>
          <td>{!! $userSharedProfile->user_id !!}</td>
          <td>{!! $userSharedProfile->shared_profile_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('userSharedProfiles.show', [$userSharedProfile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>