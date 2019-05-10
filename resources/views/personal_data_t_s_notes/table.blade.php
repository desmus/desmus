<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSNotes-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Content</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Job Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSNotes as $personalDataTSNote)
          
        <tr>
              
          <td>{!! $personalDataTSNote->name !!}</td>
          <td>{!! $personalDataTSNote->description !!}</td>
          <td>{!! $personalDataTSNote->content !!}</td>
          <td>{!! $personalDataTSNote->views_quantity !!}</td>
          <td>{!! $personalDataTSNote->updates_quantity !!}</td>
          <td>{!! $personalDataTSNote->status !!}</td>
          <td>{!! $personalDataTSNote->personalData_topic_section_id !!}</td>
              
          <td>
              
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSNotes.show', [$personalDataTSNote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>