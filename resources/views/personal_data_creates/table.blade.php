<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal Data Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($personalDataCreates as $personalDataCreate)
        
        <tr>
          
          <td>{!! $personalDataCreate->datetime !!}</td>
          <td>{!! $personalDataCreate->user_id !!}</td>
          <td>{!! $personalDataCreate->personal_data_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
                      
              <a href="{!! route('personalDataCreates.show', [$personalDataCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>