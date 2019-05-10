<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userPersonalDataTopicSections-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>Description</th>
        <th>Status</th>
        <th>Permissions</th>
        <th>User Id</th>
        <th>Personal Data T S Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userPersonalDataTopicSections as $userPersonalDataTopicSection)
          
        <tr>
              
          <td>{!! $userPersonalDataTopicSection->datetime !!}</td>
          <td>{!! $userPersonalDataTopicSection->description !!}</td>
          <td>{!! $userPersonalDataTopicSection->status !!}</td>
          <td>{!! $userPersonalDataTopicSection->permissions !!}</td>
          <td>{!! $userPersonalDataTopicSection->user_id !!}</td>
          <td>{!! $userPersonalDataTopicSection->personal_data_t_s_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userPersonalDataTopicSections.show', [$userPersonalDataTopicSection->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>