<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal Data Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataViews as $personalDataView)
          
        <tr>
              
          <td>{!! $personalDataView->datetime !!}</td>
          <td>{!! $personalDataView->user_id !!}</td>
          <td>{!! $personalDataView->personal_data_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataViews.show', [$personalDataView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>