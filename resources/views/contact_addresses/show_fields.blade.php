<section class="content" style="padding-bottom: 0;">
  
  <div class="row">
    
    <div class="col-md-12">
      
      <div class="nav-tabs-custom">
        
        <ul class="nav nav-tabs">
          
          <li class = "active"><a href="#address_info" data-toggle="tab"> Address Information </a></li>
          <li><a href="#address_map" data-toggle="tab"> Address Map </a></li>
          
        </ul>
        
        <div class="tab-content clearfix">
          
          <div class = "tab-pane active" id = "address_info">
            
            <div class="form-group">
                {!! Form::label('street', 'Street:') !!}
                <p>{!! $contactAddress->street !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('num_ext', 'Num Ext:') !!}
                <p>{!! $contactAddress->num_ext !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('num_int', 'Num Int:') !!}
                <p>{!! $contactAddress->num_int !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('state', 'State:') !!}
                <p>{!! $contactAddress->state !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('municipality', 'Municipality:') !!}
                <p>{!! $contactAddress->municipality !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('postal_code', 'Postal Code:') !!}
                <p>{!! $contactAddress->postal_code !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('created_at', 'Created At:') !!}
                <p>{!! $contactAddress->created_at !!}</p>
            </div>
            
            <div class="form-group">
                {!! Form::label('updated_at', 'Updated At:') !!}
                <p>{!! $contactAddress->updated_at !!}</p>
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "address_map">
            
            {!! $contactAddress->location !!}
            
          </div>
          
        </div>
        
      </div>
      
    </div>
    
  </div>
  
</section>