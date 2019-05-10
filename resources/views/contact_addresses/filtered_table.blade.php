<table class="table table-hover table-bordered table-striped dataTable" id="contactAddresses-filtered_table" style="margin-bottom: 0;">
  
  <thead>
    
    <tr>
      
      <th>Street</th>
      <th>Num. Ext</th>
      <th>Num. Int</th>
      <th>State</th>
      <th>Municipality</th>
      <th>Postal Code</th>
      <th colspan="3">Action</th>
      
    </tr>
    
  </thead>
    
  <tbody>
    
    @foreach($contactAddresses as $contactAddress)
    
      <tr>
        
        <td> <a href = "{!! route('contactAddresses.show', [$contactAddress->id]) !!}"> {!! $contactAddress->street !!} </a> </td>
        <td> {!! $contactAddress->num_ext !!} </td>
        <td> {!! $contactAddress->num_int !!} </td>
        <td> {!! $contactAddress->state !!} </td>
        <td> {!! $contactAddress->municipality !!} </td>
        <td> {!! $contactAddress->postal_code !!} </td>
        
        <td>
          
          {!! Form::open(['route' => ['contactAddresses.destroy', $contactAddress->id], 'method' => 'delete']) !!}
          
            <div class='btn-group'>
              
              <a href="{!! route('contactAddresses.show', [$contactAddress->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
              <a href="{!! route('contactAddresses.edit', [$contactAddress->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
              {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                
            </div>
            
          {!! Form::close() !!}
          
        </td>
        
      </tr>
    
    @endforeach
    
  </tbody>

</table>