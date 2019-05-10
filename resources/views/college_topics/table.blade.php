<div class="table-responsive">

  <table class="table table-bordered table-striped dataTable" id="collegeTopics-table">
      
    <thead>
          
      <tr>
              
        <th>Name</th>
        <th>User</th>
        <th colspan="3">Action</th>
          
      </tr>
      
    </thead>
      
    <tbody>
    
      @foreach($collegeTopics as $collegeTopic)
          
        <tr>
              
          <td><a> <a href = "{!! route('collegeTopics.show', [$collegeTopic->id]) !!}"> {!! $collegeTopic->name !!} </a> </td>
          <td>{!! $collegeTopic->college_id !!}</td>
          
          <td>
                  
            <div class='btn-group'>
                      
              <a href="{!! route('collegeTopics.show', [$collegeTopic->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                 
            </div>
              
          </td>
          
        </tr>
      
      @endforeach
      
    </tbody>
  
  </table>
  
</div>