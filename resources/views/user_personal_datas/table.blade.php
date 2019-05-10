<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDatas-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Personal Data Id</th>
        <th colspan="3">Action</th>
      
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDatas as $userPersonalData)
          
        <tr>
              
          <td>{!! $userPersonalData->datetime !!}</td>
          <td>{!! $userPersonalData->description !!}</td>
          <td>{!! $userPersonalData->status !!}</td>
          <td>{!! $userPersonalData->permissions !!}</td>
          <td>{!! $userPersonalData->user_id !!}</td>
          <td>{!! $userPersonalData->personal_data_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDatas.show', [$userPersonalData->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>