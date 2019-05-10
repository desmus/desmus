<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSGaleries-table">
    
    <thead>
      
      <tr>
        
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>College Topic Section Id</th>
        <th colspan="3">Action</th>
        
      </tr>
      
    </thead>
    
    <tbody>
      
      @foreach($collegeTSGaleries as $collegeTSGalerie)
      
        <tr>
          
          <td>{!! $collegeTSGalerie->name !!}</td>
          <td>{!! $collegeTSGalerie->description !!}</td>
          <td>{!! $collegeTSGalerie->views_quantity !!}</td>
          <td>{!! $collegeTSGalerie->updates_quantity !!}</td>
          <td>{!! $collegeTSGalerie->status !!}</td>
          <td>{!! $collegeTSGalerie->college_topic_section_id !!}</td>
          <td>
            
            <div class='btn-group'>
                
              <a href="{!! route('collegeTSGaleries.show', [$collegeTSGalerie->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
            
          </td>
        
        </tr>
      
      @endforeach
      
    </tbody>
    
  </table>
  
</div>