<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTSTools-table">
      
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
      
      @foreach($collegeTSTools as $collegeTSTool)
          
        <tr>
              
          <td>{!! $collegeTSTool->name !!}</td>
          <td>{!! $collegeTSTool->description !!}</td>
          <td>{!! $collegeTSTool->views_quantity !!}</td>
          <td>{!! $collegeTSTool->updates_quantity !!}</td>
          <td>{!! $collegeTSTool->status !!}</td>
          <td>{!! $collegeTSTool->college_topic_section_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('collegeTSTools.show', [$collegeTSTool->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>