<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeViews-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>College Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($collegeViews as $collegeView)
          
        <tr>
              
          <td>{!! $collegeView->datetime !!}</td>
          <td>{!! $collegeView->user_id !!}</td>
          <td>{!! $collegeView->college_id !!}</td>
              
          <td>
            
              <div class='btn-group'>
                      
                <a href="{!! route('collegeViews.show', [$collegeView->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              
              </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>