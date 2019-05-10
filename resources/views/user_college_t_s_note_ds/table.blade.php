<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="userCollegeTSNoteDs-table">
      
    <thead>
          
      <tr>
              
        <th>Datetime</th>
        <th>User Id</th>
        <th>User C T S N Id</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
     
      @foreach($userCollegeTSNoteDs as $userCollegeTSNoteD)
          
        <tr>
              
          <td>{!! $userCollegeTSNoteD->datetime !!}</td>
          <td>{!! $userCollegeTSNoteD->user_id !!}</td>
          <td>{!! $userCollegeTSNoteD->user_c_t_s_n_id !!}</td>
              
          <td>
            
            <div class='btn-group'>
              
              <a href="{!! route('userCollegeTSNoteDs.show', [$userCollegeTSNoteD->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
            </div>
          
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>