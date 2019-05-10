<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSGaleries-table">
    
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
      
      @foreach($projectTSGaleries as $projectTSGalerie)
      
        <tr>
          
          <td>{!! $projectTSGalerie->name !!}</td>
          <td>{!! $projectTSGalerie->description !!}</td>
          <td>{!! $projectTSGalerie->views_quantity !!}</td>
          <td>{!! $projectTSGalerie->updates_quantity !!}</td>
          <td>{!! $projectTSGalerie->status !!}</td>
          <td>{!! $projectTSGalerie->project_topic_section_id !!}</td>
          <td>
            
            <div class='btn-group'>
                
              <a href="{!! route('projectTSGaleries.show', [$projectTSGalerie->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
            
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>