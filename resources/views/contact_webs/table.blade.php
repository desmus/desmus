<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="contactWebs-table">
      
    <thead>
          
      <tr>
      
        <th>Link</th>
        <th>Contact Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($contactWebs as $contactWeb)
          
        <tr>
              
          <td>{!! $contactWeb->link !!}</td>
          <td>{!! $contactWeb->contact_id !!}</td>
        
          <td>
          
            <div class='btn-group'>
            
              <a href="{!! route('contactWebs.show', [$contactWeb->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
          
            </div>
        
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>

</div>