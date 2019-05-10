<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSGaleries-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>Description</th>
        <th>Views Quantity</th>
        <th>Updates Quantity</th>
        <th>Status</th>
        <th>Job Topic Section Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataTSGaleries as $personalDataTSGalerie)
          
        <tr>
              
          <td>{!! $personalDataTSGalerie->name !!}</td>
          <td>{!! $personalDataTSGalerie->description !!}</td>
          <td>{!! $personalDataTSGalerie->views_quantity !!}</td>
          <td>{!! $personalDataTSGalerie->updates_quantity !!}</td>
          <td>{!! $personalDataTSGalerie->status !!}</td>
          <td>{!! $personalDataTSGalerie->personalData_topic_section_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('personalDataTSGaleries.show', [$personalDataTSGalerie->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>

</div>