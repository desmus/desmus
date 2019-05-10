@section('scripts')

  <script>

    DecoupledEditor
            
      .create(document.querySelector('#editor'))
            
      .then( editor => {
                
        const toolbarContainer = document.querySelector('#toolbar-container');
        toolbarContainer.appendChild( editor.ui.view.toolbar.element );
            
      })
            
      .catch( error => {
                
        console.error(error);
        
      });

  </script>

  <script>

    var jq=jQuery.noConflict();
    
    jq(document).ready( function(){
      
      jq(document).keydown(function(event){

        var content = document.getElementById("editor").children;
        var contentCount = document.getElementById("editor").childElementCount;

        jq(document).ready(function($){

          $("#text").empty();

          var allText = "";

          for(var i = 0; i < contentCount; i++)
          {
            allText = allText + content[i].outerHTML;
          }

          var text = $('#text');

          text.val(allText);

        });
        
      });
      
      jq(document).mousedown(function(event){

        var content = document.getElementById("editor").children;
        var contentCount = document.getElementById("editor").childElementCount;

        jq(document).ready(function($){

          $("#text").empty();

          var allText = "";

          for(var i = 0; i < contentCount; i++)
          {
            allText = allText + content[i].outerHTML;
          }

          var text = $('#text');

          text.val(allText);

        });
        
      });
    
    });

  </script>

@endsection

<section class="content" style="padding-bottom: 0; min-height: 30px;">

  <div class="row">
 
    <div class="col-md-12">
          
      <div class="nav-tabs-custom">
            
        <ul class="nav nav-tabs">

          <li class = "active"><a href="#contact_info" data-toggle="tab"> Information </a></li>
          <li><a href="#address_info" data-toggle="tab"> Addresses </a></li>
          <li><a href="#telephone_info" data-toggle="tab"> Telephones </a></li>
          <li><a href="#email_info" data-toggle="tab"> Emails </a></li>
          <li><a href="#social_info" data-toggle="tab"> Socials </a></li>
          <li><a href="#web_info" data-toggle="tab"> Webs </a></li>
          <li><a href="#contact_specific_info" data-toggle="tab"> Specific Information </a></li>
          <li><a href="#contact_statistics" data-toggle="tab"> Statistics </a></li>
          <li><a href="#contact_views_history" data-toggle="tab"> Views History </a></li>
          <li><a href="#contact_updates_history" data-toggle="tab"> Updates History </a></li>

        </ul>

        <div class="tab-content clearfix">
          
          <div class = "tab-pane active" id = "contact_info">
            
            <div class="form-group">
              {!! Form::label('name', 'Name:') !!}
              <p>{!! $contact[0]->name !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('email', 'Email:') !!}
              <p>{!! $contact[0]->email !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('business', 'Business:') !!}
              <p>{!! $contact[0]->business !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('job', 'Job:') !!}
              <p>{!! $contact[0]->job !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('country', 'Country:') !!}
              <p>{!! $contact[0]->country !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('birthdate', 'Birthdate:') !!}
              <p>{!! $contact[0]->birthdate !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('created_at', 'Created At:') !!}
              <p>{!! $contact[0]->created_at !!}</p>
            </div>
            
            <div class="form-group">
              {!! Form::label('updated_at', 'Updated At:') !!}
              <p>{!! $contact[0]->updated_at !!}</p>
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "address_info">
            
            <div class="row">
              
              <div class="col-sm-12">
                
                <div class="table-responsive" style="min-height: 30px; margin-bottom: 0;">
                  
                  @include('contact_addresses.filtered_table')
                  
                </div>
                
                <div class="mailbox-controls">
                              
                  <div class="btn-group">
                                  
                  </div>
                                
                  <div class="pull-right" style="margin-top: 10px;">
                                
                    1-50
                                  
                    <div class="btn-group">
                                    
                      @if($contact_address_p < 1)
                        
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_address_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_address_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                    
                      @endif
                                    
                      @if($contact_address_p == 1)
                                                  
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_address_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_address_p={!! $contact_address_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                      @endif
                                      
                      @if($contact_address_p > 1)
                                      
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_address_p={!! $contact_address_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_address_p={!! $contact_address_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                      @endif
                                    
                    </div>
                                
                  </div>
                                
                </div>
                
              </div>
              
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "telephone_info">
            
            <div class="row">
              
              <div class="col-sm-12">
                
                <div class="table-responsive" style="min-height: 30px; margin-bottom: 0;">
                  
                  @include('contact_telephones.filtered_table')
                  
                </div>
                
                <div class="mailbox-controls">
                              
                  <div class="btn-group">
                                  
                  </div>
                                
                  <div class="pull-right" style="margin-top: 10px;">
                                
                    1-50
                                  
                    <div class="btn-group">
                                    
                      @if($contact_telephone_p < 1)
                        
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_telephone_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_telephone_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                    
                      @endif
                                    
                      @if($contact_telephone_p == 1)
                                                  
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_telephone_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_telephone_p={!! $contact_telephone_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                      @endif
                                      
                      @if($contact_telephone_p > 1)
                                      
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_telephone_p={!! $contact_telephone_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_telephone_p={!! $contact_telephone_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                      @endif
                      
                    </div>
                                
                  </div>
                                
                </div>
            
              </div>
              
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "email_info">
            
            <div class="row">
              
              <div class="col-sm-12">
                
                <div class="table-responsive" style="min-height: 30px; margin-bottom: 0;">
                  
                  @include('contact_emails.filtered_table')
                  
                </div>
                
                <div class="mailbox-controls" style="margin-top: 10px;">
                              
                  <div class="btn-group">
                                  
                  </div>
                                
                  <div class="pull-right">
                                
                    1-50
                                  
                    <div class="btn-group">
                                    
                      @if($contact_email_p < 1)
                        
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_email_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_email_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                    
                      @endif
                                    
                      @if($contact_email_p == 1)
                                                  
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_email_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_email_p={!! $contact_email_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                      @endif
                                      
                      @if($contact_email_p > 1)
                                      
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_email_p={!! $contact_email_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_email_p={!! $contact_email_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                      @endif
                      
                    </div>
                                
                  </div>
                                
                </div>
                
              </div>
              
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "social_info">
            
            <div class="row">
              
              <div class="col-sm-12">
                
                <div class="table-responsive" style="min-height: 30px; margin-bottom: 0;">
                  
                  @include('contact_socials.filtered_table')
                  
                </div>
                
                <div class="mailbox-controls" style="margin-top: 10px;">
                              
                  <div class="btn-group">
                                  
                  </div>
                                
                  <div class="pull-right">
                                
                    1-50
                                  
                    <div class="btn-group">
                                    
                      @if($contact_social_p < 1)
                        
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_social_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_social_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                    
                      @endif
                                    
                      @if($contact_social_p == 1)
                                                  
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_social_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_social_p={!! $contact_social_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                      @endif
                                      
                      @if($contact_social_p > 1)
                                      
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_social_p={!! $contact_social_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_social_p={!! $contact_social_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                      @endif
                      
                    </div>
                                
                  </div>
                                
                </div>
                
              </div>
              
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "web_info">
            
            <div class="row">
              
              <div class="col-sm-12">
                
                <div class="table-responsive" style="min-height: 30px; margin-bottom: 0;">
                  
                  @include('contact_webs.filtered_table')
                  
                </div>
                
                <div class="mailbox-controls" style="margin-top: 10px;">
                              
                  <div class="btn-group">
                                  
                  </div>
                                
                  <div class="pull-right">
                                
                    1-50
                                  
                    <div class="btn-group">
                                    
                      @if($contact_web_p < 1)
                        
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_web_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_web_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                    
                      @endif
                                    
                      @if($contact_web_p == 1)
                                                  
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_web_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_web_p={!! $contact_web_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                      @endif
                                      
                      @if($contact_web_p > 1)
                                      
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_web_p={!! $contact_web_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                        <a href = "http://desmus-jmsp.c9users.io/contacts/{!! $id !!}?contact_web_p={!! $contact_web_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                      @endif
                      
                    </div>
                                
                  </div>
                                
                </div>
                
              </div>
              
            </div>
            
          </div>
          
          <div class = "tab-pane" id = "contact_specific_info">
            
            <div id="toolbar-container"></div>
            
            {!! Form::model($contact, ['route' => ['contacts.update', $contact[0]->id], 'method' => 'patch']) !!}
            
              <div class = "form-group" id="editor" style="margin-bottom: 0;"> {!! $contact[0]->specific_info !!} </div>
              
              <textarea id = "text" name = "specific_info" hidden> </textarea>
              
              <div class="form-group col-sm-6">
                <input type = "datetime" name = "updated_at" value = "{!! $now !!}" hidden>
              </div>
              
              <div class="form-group col-sm-12" style="margin-bottom: 0;">
                {!! Form::submit('Save', ['class' => 'btn pull-right btn-primary']) !!}
              </div>
              
            {!! Form::close() !!}
            
          </div>
          
          <div class = "tab-pane" id = "contact_statistics">
            
            <div class="col-lg-6 col-xs-6">
              
              <div class="small-box bg-green" style="margin-bottom: 0;">
                
                <div class="inner">
                  
                  <h3><sup style="font-size: 20px">{!! $contact[0] -> views_quantity !!}</sup></h3>
                  
                  <p>Views Quantity</p>
            
                </div>
            
                <div class="icon">
              
                  <i class="ion ion-stats-bars"></i>
            
                </div>
            
                <a href = "#contact_views_history" data-toggle="tab" class="small-box-footer">
            
                  More Information
            
                </a>
          
              </div>
        
            </div>

            <div class="col-lg-6 col-xs-6">
          
              <div class="small-box bg-red" style="margin-bottom: 0;">
            
                <div class="inner">
              
                  <h3><sup style="font-size: 20px">{!! $contact[0] -> updates_quantity !!}</sup></h3>

                  <p>Updates Quantity</p>
            
                </div>
            
                <div class="icon">
              
                  <i class="ion ion-stats-bars"></i>
            
                </div>
            
                <a href = "#contact_updates_history" data-toggle="tab" class="small-box-footer">
            
                  More Information
            
                </a>
          
              </div>
        
            </div>

          </div>
          
          <div class = "tab-pane" id = "contact_views_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">

                      <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="margin-bottom: 0;">
                
                        <thead>
                
                          <tr role="row">

                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 182px;"> Datetime </th>
                            
                          </tr>
                
                        </thead>
                
                        <tbody>
                  
                          @foreach($contactViews as $contactView)

                            <tr role="row" class="odd">
                            
                              <td class=""> {!! $contactView->datetime !!} </td>
                
                            </tr>
    
                          @endforeach

                        </tbody>
              
                      </table>

                    </div>

                  </div>

                </div>
            
              </div>

            </div>

          </div>

          <div class = "tab-pane" id = "contact_updates_history">

            <div class="box box-primary" style="margin-bottom: 0;">

              <div class="box-body">
              
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                  <div class="row">

                    <div class="col-sm-12">

                      <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="margin-bottom: 0;">
                
                        <thead>
                
                          <tr role="row">
                            
                            <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;" aria-sort="descending"> Datetime </th>

                          </tr>
                
                        </thead>
                
                        <tbody>
                  
                          @foreach($contactUpdates as $contactUpdate)

                            <tr role="row" class="odd">
                              
                              <td class="sorting_1"> {!! $contactUpdate->datetime !!} </td>
                
                            </tr>
    
                          @endforeach

                        </tbody>
              
                      </table>

                    </div>

                  </div>

                </div>
            
              </div>

            </div>

          </div>

        </div>

      </div>
              
    </div>
            
  </div>

</section>