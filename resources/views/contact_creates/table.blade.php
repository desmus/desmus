<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactCreates-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>Contact Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($contactCreates as $contactCreate)
          
        <tr>
              
          <td>{!! $contactCreate->datetime !!}</td>
          <td>{!! $contactCreate->user_id !!}</td>
          <td>{!! $contactCreate->contact_id !!}</td>
              
          <td>
                  
            <div class='btn-group'>
              
              <a href="{!! route('contactCreates.show', [$contactCreate->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>