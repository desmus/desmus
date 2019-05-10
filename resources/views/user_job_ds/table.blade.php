<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userJobDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User J Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
      
      @foreach($userJobDs as $userJobD)
          
        <tr>
              
          <td>{!! $userJobD->datetime !!}</td>
          <td>{!! $userJobD->user_id !!}</td>
          <td>{!! $userJobD->user_j_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userJobDs.show', [$userJobD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>