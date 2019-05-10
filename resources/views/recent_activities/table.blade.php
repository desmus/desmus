<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="recentActivities-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Status</th>
        <th>Type</th>
        <th>Entity Id</th>
        <th>User Id</th>
        <th>Created At</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($recentActivities as $recentActivity)
          
        <tr>
              
          <td>{!! $recentActivity->name !!}</td>
          <td>{!! $recentActivity->status !!}</td>
          <td>{!! $recentActivity->type !!}</td>
          <td>{!! $recentActivity->entity_id !!}</td>
          <td>{!! $recentActivity->user_id !!}</td>
          <td>{!! $recentActivity->created_at !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('recentActivities.show', [$recentActivity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>

</div>