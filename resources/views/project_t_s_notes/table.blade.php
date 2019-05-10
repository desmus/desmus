<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="projectTSNotes-table">
    
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Content</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Project Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($projectTSNotes as $projectTSNote)
          
        <tr>
              
          <td>{!! $projectTSNote->name !!}</td>
          <td>{!! $projectTSNote->description !!}</td>
          <td>{!! $projectTSNote->content !!}</td>
          <td>{!! $projectTSNote->views_quantity !!}</td>
          <td>{!! $projectTSNote->updates_quantity !!}</td>
          <td>{!! $projectTSNote->status !!}</td>
          <td>{!! $projectTSNote->project_topic_section_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('projectTSNotes.show', [$projectTSNote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
          
            </div>
        
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>