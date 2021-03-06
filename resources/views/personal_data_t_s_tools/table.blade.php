<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataTSTools-table">
      
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
      
      @foreach($personalDataTSTools as $personalDataTSTool)
          
        <tr>
              
          <td>{!! $personalDataTSTool->name !!}</td>
          <td>{!! $personalDataTSTool->description !!}</td>
          <td>{!! $personalDataTSTool->views_quantity !!}</td>
          <td>{!! $personalDataTSTool->updates_quantity !!}</td>
          <td>{!! $personalDataTSTool->status !!}</td>
          <td>{!! $personalDataTSTool->personalData_topic_section_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataTSTools.show', [$personalDataTSTool->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>