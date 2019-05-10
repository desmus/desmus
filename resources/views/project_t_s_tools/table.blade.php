<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSTools-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Project Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSTools as $projectTSTool)
          
        <tr>
              
          <td>{!! $projectTSTool->name !!}</td>
          <td>{!! $projectTSTool->description !!}</td>
          <td>{!! $projectTSTool->views_quantity !!}</td>
          <td>{!! $projectTSTool->updates_quantity !!}</td>
          <td>{!! $projectTSTool->status !!}</td>
          <td>{!! $projectTSTool->project_topic_section_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('projectTSTools.show', [$projectTSTool->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>