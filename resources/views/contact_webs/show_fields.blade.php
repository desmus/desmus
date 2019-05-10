<section class="content" style="padding-bottom: 0;">
  
  <div class="row">
    
    <div class="col-md-12">
      
      <div class="nav-tabs-custom">
        
        <ul class="nav nav-tabs">
          
          <li class = "active"><a href="#web_info" data-toggle="tab"> Web Information </a></li>
          <li><a href="#web_page" data-toggle="tab"> Web Page </a></li>
          
        </ul>
        
        <div class="tab-content clearfix">
          
          <div class = "tab-pane active" id = "web_info">
            
            <div class="form-group">
              {!! Form::label('link', 'Link:') !!}
              <p>{!! $contactWeb->link !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('created_at', 'Created At:') !!}
              <p>{!! $contactWeb->created_at !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('updated_at', 'Updated At:') !!}
              <p>{!! $contactWeb->updated_at !!}</p>
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "web_page">
            
            <iframe src="{!! $contactWeb->link !!}">
              alternative content for browsers which do not support iframe.
            </iframe>
            
          </div>
          
        </div>
        
      </div>
      
    </div>
    
  </div>
  
</section>