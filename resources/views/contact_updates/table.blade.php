<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactUpdates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($contactUpdates as $contactUpdate)
          
        <tr>
              
          <td>{!! $contactUpdate->datetime !!}</td>
          <td>{!! $contactUpdate->user_id !!}</td>
          <td>{!! $contactUpdate->contact_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('contactUpdates.show', [$contactUpdate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>