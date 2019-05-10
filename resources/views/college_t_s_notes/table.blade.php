<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSNotes-table">
    
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Content</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>College Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeTSNotes as $collegeTSNote)
          
        <tr>
              
          <td>{!! $collegeTSNote->name !!}</td>
          <td>{!! $collegeTSNote->description !!}</td>
          <td>{!! $collegeTSNote->content !!}</td>
          <td>{!! $collegeTSNote->views_quantity !!}</td>
          <td>{!! $collegeTSNote->updates_quantity !!}</td>
          <td>{!! $collegeTSNote->status !!}</td>
          <td>{!! $collegeTSNote->college_topic_section_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTSNotes.show', [$collegeTSNote->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
          
            </div>
        
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>