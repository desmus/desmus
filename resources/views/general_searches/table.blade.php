<table class="table table-responsive" id="generalSearches-table">
    
  <thead>
        
    <tr>
            
      <th>Search</th>
      <th>Entity Type</th>
      <th>Entity Id</th>
      <th>User Id</th>
      <th colspan="3">Action</th>
        
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($generalSearches as $generalSearch)
        
      <tr>
            
        <td>{!! $generalSearch->search !!}</td>
        <td>{!! $generalSearch->entity_type !!}</td>
        <td>{!! $generalSearch->entity_id !!}</td>
        <td>{!! $generalSearch->user_id !!}</td>
            
        <td>
                
          <a href="{!! route('generalSearches.show', [$generalSearch->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            
        </td>
        
      </tr>
      
    @endforeach
    
  </tbody>

</table>