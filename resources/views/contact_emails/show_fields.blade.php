<section class="content" style="padding-bottom: 0;">
  
  <div class="row">
    
    <div class="col-md-12">
      
      <div class="nav-tabs-custom">
        
        <ul class="nav nav-tabs">
          
          <li class = "active"><a href="#email_info" data-toggle="tab"> Address Information </a></li>
          
        </ul>
        
        <div class="tab-content clearfix">
          
          <div class = "tab-pane active" id = "email_info">
            
            <div class="form-group">
              {!! Form::label('email', 'Email:') !!}
              <p>{!! $contactEmail->email !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('type', 'Type:') !!}
              <p>{!! $contactEmail->type !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('created_at', 'Created At:') !!}
              <p>{!! $contactEmail->created_at !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('updated_at', 'Updated At:') !!}
              <p>{!! $contactEmail->updated_at !!}</p>
            </div>
            
          </div>
          
        </div>
        
      </div>
      
    </div>
    
  </div>
  
</section>