<section class="content" style="padding-bottom: 0;">
  
  <div class="row">
    
    <div class="col-md-12">
      
      <div class="nav-tabs-custom">
        
        <ul class="nav nav-tabs">
          
          <li class = "active"><a href="#social_info" data-toggle="tab"> Social Media Information </a></li>
          <li><a href="#social_page" data-toggle="tab"> Social Media Page </a></li>
          
        </ul>
        
        <div class="tab-content clearfix">
          
          <div class = "tab-pane active" id = "social_info">
            
            <div class="form-group">
              {!! Form::label('link', 'Link:') !!}
              <p>{!! $contactSocial->link !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('created_at', 'Created At:') !!}
              <p>{!! $contactSocial->created_at !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('updated_at', 'Updated At:') !!}
              <p>{!! $contactSocial->updated_at !!}</p>
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "social_page">
            
            <iframe src="{!! $contactSocial->link !!}">
              alternative content for browsers which do not support iframe.
            </iframe>
            
          </div>
          
        </div>
        
      </div>
      
    </div>
    
  </div>
  
</section>