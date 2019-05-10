<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="personalDataDeletes-table">
    
    <thead>
        
      <tr>
            
        <th>Datetime</th>
        <th>User Id</th>
        <th>Personal Data Id</th>
        <th colspan="3">Action</th>
        
      </tr>
    
    </thead>
    
    <tbody>
      
      @foreach($personalDataDeletes as $personalDataDelete)
        
        <tr>
            
          <td>{!! $personalDataDelete->datetime !!}</td>
          <td>{!! $personalDataDelete->user_id !!}</td>
          <td>{!! $personalDataDelete->personal_data_id !!}</td>
          
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('personalDataDeletes.show', [$personalDataDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
        
        </tr>
    
      @endforeach
    
    </tbody>

  </table>
  
</div>