<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactDeletes-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($contactDeletes as $contactDelete)
          
        <tr>
              
          <td>{!! $contactDelete->datetime !!}</td>
          <td>{!! $contactDelete->user_id !!}</td>
          <td>{!! $contactDelete->contact_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('contactDeletes.show', [$contactDelete->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>