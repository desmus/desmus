<section class="content" style="padding-bottom: 0;">
  
  <div class="row">
    
    <div class="col-md-12">
      
      <div class="nav-tabs-custom">
        
        <ul class="nav nav-tabs">
          
          <li class = "active"><a href="#address_info" data-toggle="tab"> Telephone Information </a></li>
          
        </ul>
        
        <div class="tab-content clearfix">
          
          <div class = "tab-pane active" id = "address_info">
            
            <div class="form-group">
              {!! Form::label('telephone', 'Telephone:') !!}
              <p>{!! $contactTelephone->telephone !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('type', 'Type:') !!}
              <p>{!! $contactTelephone->type !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('created_at', 'Created At:') !!}
              <p>{!! $contactTelephone->created_at !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('updated_at', 'Updated At:') !!}
              <p>{!! $contactTelephone->updated_at !!}</p>
            </div>
            
          </div>
          
        </div>
        
      </div>
      
    </div>
    
  </div>
  
</section>