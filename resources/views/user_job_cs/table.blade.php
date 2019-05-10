<div class="table-responsive">

  <table class="table table-responsive" id="userJobCs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User J Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobCs as $userJobC)
          
        <tr>
              
          <td>{!! $userJobC->datetime !!}</td>
          <td>{!! $userJobC->user_id !!}</td>
          <td>{!! $userJobC->user_j_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobCs.show', [$userJobC->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>