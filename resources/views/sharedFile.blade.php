@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Shared Files </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row" style="padding: 0;">
            
          <div class="col-md-12">
            
            <div class="nav-tabs-custom" style="margin-bottom: 0;">
                
              <ul class="nav nav-tabs">
                  
                <li class = "active"><a href="#colleges" data-toggle="tab"> Colleges </a></li>
                <li><a href="#jobs" data-toggle="tab"> Jobs </a></li>
                <li><a href="#projects" data-toggle="tab"> Projects </a></li>
                <li><a href="#personal_datas" data-toggle="tab"> Personal Data </a></li>
                <li><a href="#calendar_events" data-toggle="tab"> Calendar Events </a></li>
                  
              </ul>
                
              <div class="tab-content clearfix">
                  
                <div class = "tab-pane active" id = "colleges">
                  
                  <div class="box box-primary" style="margin-bottom: 0;">
            
                    <div class="box-body">
                              
                      <div class="row">
                          
                        <div class="col-md-12">
                          
                          <div class="nav-tabs-custom" style="margin-bottom: 0;">
                              
                            <ul class="nav nav-tabs">
                                
                              <li class = "active"><a href="#s_colleges" data-toggle="tab"> Colleges </a></li>
                              <li><a href="#college_topics" data-toggle="tab"> Topics </a></li>
                              <li><a href="#college_sections" data-toggle="tab"> Sections </a></li>
                              <li><a href="#college_files" data-toggle="tab"> Files </a></li>
                              <li><a href="#college_notes" data-toggle="tab"> Notes </a></li>
                              <li><a href="#college_galeries" data-toggle="tab"> Galeries </a></li>
                              <li><a href="#college_images" data-toggle="tab"> Images </a></li>
                              <li><a href="#college_playlists" data-toggle="tab"> Playlists </a></li>
                              <li><a href="#college_audios" data-toggle="tab"> Audios </a></li>
                              <li><a href="#college_tools" data-toggle="tab"> Tools </a></li>
                              <li><a href="#college_tool_files" data-toggle="tab"> Tool Files </a></li>
                                
                            </ul>
                            
                            <div class="tab-content clearfix">
                              
                              <div class = "tab-pane active" id = "s_colleges">
                              
                                <div class="row">

                                  <div class="col-sm-12">
                      
                                    <div class="table-responsive">

                                      <table class="table table-responsive">
    
                                        <thead>
                                          
                                    <tr>
                                              
                                      <th>College Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($colleges as $college)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('colleges.show', [$college->college_id]) !!}"> {!! $college->college_name !!} </a> </td>
                                        <td> {!! $college->user_name !!} </td>
                                        <td> {!! $college->email !!} </td>
                                        <td> {!! $college->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($college_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($college_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_p={!! $college_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($college_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_p={!! $college_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_p={!! $college_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "college_topics">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Topic Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($collegeTopics as $collegeTopic)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('collegeTopics.show', [$collegeTopic->topic_id]) !!}"> {!! $collegeTopic->topic_name !!} </a> </td>
                                        <td> {!! $collegeTopic->user_name !!} </td>
                                        <td> {!! $collegeTopic->email !!} </td>
                                        <td> {!! $collegeTopic->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($college_topic_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_topic_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_topic_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($college_topic_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_topic_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_topic_p={!! $college_topic_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($college_topic_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_topic_p={!! $college_topic_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_topic_p={!! $college_topic_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "college_sections">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Section Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($collegeSections as $collegeSection)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('collegeTopicSections.show', [$collegeSection->section_id]) !!}"> {!! $collegeSection->section_name !!} </a> </td>
                                        <td> {!! $collegeSection->user_name !!} </td>
                                        <td> {!! $collegeSection->email !!} </td>
                                        <td> {!! $collegeSection->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>

                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($college_section_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_section_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_section_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($college_section_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_section_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_section_p={!! $college_section_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($college_section_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_section_p={!! $college_section_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_section_p={!! $college_section_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "college_files">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>File Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($collegeFiles as $collegeFile)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('collegeTSFiles.show', [$collegeFile->file_id]) !!}"> {!! $collegeFile->file_name !!} </a> </td>
                                        <td> {!! $collegeFile->user_name !!} </td>
                                        <td> {!! $collegeFile->email !!} </td>
                                        <td> {!! $collegeFile->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($college_file_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_file_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_file_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($college_file_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_file_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_file_p={!! $college_file_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($college_file_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_file_p={!! $college_file_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_file_p={!! $college_file_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "college_notes">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Note Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($collegeNotes as $collegeNote)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('collegeTSNotes.show', [$collegeNote->note_id]) !!}"> {!! $collegeNote->note_name !!} </a> </td>
                                        <td> {!! $collegeNote->user_name !!} </td>
                                        <td> {!! $collegeNote->email !!} </td>
                                        <td> {!! $collegeNote->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($college_note_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_note_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_note_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($college_note_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_note_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_note_p={!! $college_note_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($college_note_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_note_p={!! $college_note_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_note_p={!! $college_note_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "college_galeries">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Galery Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($collegeGaleries as $collegeGalery)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('collegeTSGaleries.show', [$collegeGalery->galery_id]) !!}"> {!! $collegeGalery->galery_name !!} </a> </td>
                                        <td> {!! $collegeGalery->user_name !!} </td>
                                        <td> {!! $collegeGalery->email !!} </td>
                                        <td> {!! $collegeGalery->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($college_galery_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_galery_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_galery_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($college_galery_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_galery_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_galery_p={!! $college_galery_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($college_galery_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_galery_p={!! $college_galery_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_galery_p={!! $college_galery_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "college_images">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Image Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($collegeImages as $collegeImage)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('collegeTSGaleryImages.show', [$collegeImage->image_id]) !!}"> {!! $collegeImage->image_name !!} </a> </td>
                                        <td> {!! $collegeImage->user_name !!} </td>
                                        <td> {!! $collegeImage->email !!} </td>
                                        <td> {!! $collegeImage->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($college_image_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_image_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_image_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($college_image_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_image_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_image_p={!! $college_image_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($college_image_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_image_p={!! $college_image_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_image_p={!! $college_image_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "college_playlists">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Playlist Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($collegePlaylists as $collegePlaylist)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('collegeTSPlaylists.show', [$collegePlaylist->playlist_id]) !!}"> {!! $collegePlaylist->playlist_name !!} </a> </td>
                                        <td> {!! $collegePlaylist->user_name !!} </td>
                                        <td> {!! $collegePlaylist->email !!} </td>
                                        <td> {!! $collegePlaylist->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($college_playlist_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_playlist_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_playlist_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($college_playlist_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_playlist_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_playlist_p={!! $college_playlist_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($college_playlist_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_playlist_p={!! $college_playlist_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_playlist_p={!! $college_playlist_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "college_audios">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Audio Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($collegeAudios as $collegeAudio)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('collegeTSPAudios.show', [$collegeAudio->audio_id]) !!}"> {!! $collegeAudio->audio_name !!} </a> </td>
                                        <td> {!! $collegeAudio->user_name !!} </td>
                                        <td> {!! $collegeAudio->email !!} </td>
                                        <td> {!! $collegeAudio->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($college_audio_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_audio_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_audio_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($college_audio_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_audio_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_audio_p={!! $college_audio_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($college_audio_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_audio_p={!! $college_audio_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_audio_p={!! $college_audio_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "college_tools">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Tool Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($collegeTools as $collegeTool)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('collegeTSTools.show', [$collegeTool->tool_id]) !!}"> {!! $collegeTool->tool_name !!} </a> </td>
                                        <td> {!! $collegeTool->user_name !!} </td>
                                        <td> {!! $collegeTool->email !!} </td>
                                        <td> {!! $collegeTool->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($college_tool_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_tool_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_tool_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($college_tool_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_tool_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_tool_p={!! $college_tool_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($college_tool_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_tool_p={!! $college_tool_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_tool_p={!! $college_tool_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "college_tool_files">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Tool File Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($collegeToolFiles as $collegeToolFile)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('collegeTSToolFiles.show', [$collegeToolFile->tool_id]) !!}"> {!! $collegeToolFile->tool_name !!} </a> </td>
                                        <td> {!! $collegeToolFile->user_name !!} </td>
                                        <td> {!! $collegeToolFile->email !!} </td>
                                        <td> {!! $collegeToolFile->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($college_tool_file_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_tool_file_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_tool_file_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($college_tool_file_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_tool_file_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_tool_file_p={!! $college_tool_file_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($college_tool_file_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_tool_file_p={!! $college_tool_file_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?college_tool_file_p={!! $college_tool_file_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
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
                      
                    </div>
                    
                  </div>
                    
                </div>
                  
                <div class = "tab-pane" id = "jobs">
                  
                  <div class="box box-primary" style="margin-bottom: 0;">
            
                    <div class="box-body">
                              
                      <div class="row">
                          
                        <div class="col-md-12">
                          
                          <div class="nav-tabs-custom" style="margin-bottom: 0;">
                              
                            <ul class="nav nav-tabs">
                                
                              <li class = "active"><a href="#s_jobs" data-toggle="tab"> Jobs </a></li>
                              <li><a href="#job_topics" data-toggle="tab"> Topics </a></li>
                              <li><a href="#job_sections" data-toggle="tab"> Sections </a></li>
                              <li><a href="#job_files" data-toggle="tab"> Files </a></li>
                              <li><a href="#job_notes" data-toggle="tab"> Notes </a></li>
                              <li><a href="#job_galeries" data-toggle="tab"> Galeries </a></li>
                              <li><a href="#job_images" data-toggle="tab"> Images </a></li>
                              <li><a href="#job_playlists" data-toggle="tab"> Playlists </a></li>
                              <li><a href="#job_audios" data-toggle="tab"> Audios </a></li>
                              <li><a href="#job_tools" data-toggle="tab"> Tools </a></li>
                              <li><a href="#job_tool_files" data-toggle="tab"> Tool Files </a></li>
                                
                            </ul>
                            
                            <div class="tab-content clearfix">
                              
                              <div class = "tab-pane active" id = "s_jobs">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Job Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($jobs as $job)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('jobs.show', [$job->job_id]) !!}"> {!! $job->job_name !!} </a> </td>
                                        <td> {!! $job->user_name !!} </td>
                                        <td> {!! $job->email !!} </td>
                                        <td> {!! $job->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($job_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($job_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_p={!! $job_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($job_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_p={!! $job_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_p={!! $job_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "job_topics">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Topic Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($jobTopics as $jobTopic)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('jobTopics.show', [$jobTopic->topic_id]) !!}"> {!! $jobTopic->topic_name !!} </a> </td>
                                        <td> {!! $jobTopic->user_name !!} </td>
                                        <td> {!! $jobTopic->email !!} </td>
                                        <td> {!! $jobTopic->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($job_topic_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_topic_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_topic_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($job_topic_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_topic_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_topic_p={!! $job_topic_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($job_topic_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_topic_p={!! $job_topic_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_topic_p={!! $job_topic_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "job_sections">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Section Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($jobSections as $jobSection)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('jobTopicSections.show', [$jobSection->section_id]) !!}"> {!! $jobSection->section_name !!} </a> </td>
                                        <td> {!! $jobSection->user_name !!} </td>
                                        <td> {!! $jobSection->email !!} </td>
                                        <td> {!! $jobSection->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($job_section_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_section_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_section_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($job_section_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_section_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_section_p={!! $job_section_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($job_section_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_section_p={!! $job_section_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_section_p={!! $job_section_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "job_files">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>File Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($jobFiles as $jobFile)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('jobTSFiles.show', [$jobFile->file_id]) !!}"> {!! $jobFile->file_name !!} </a> </td>
                                        <td> {!! $jobFile->user_name !!} </td>
                                        <td> {!! $jobFile->email !!} </td>
                                        <td> {!! $jobFile->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($job_file_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_file_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_file_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($job_file_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_file_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_file_p={!! $job_file_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($job_file_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_file_p={!! $job_file_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_file_p={!! $job_file_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "job_notes">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Note Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($jobNotes as $jobNote)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('jobTSNotes.show', [$jobNote->note_id]) !!}"> {!! $jobNote->note_name !!} </a> </td>
                                        <td> {!! $jobNote->user_name !!} </td>
                                        <td> {!! $jobNote->email !!} </td>
                                        <td> {!! $jobNote->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($job_note_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_note_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_note_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($job_note_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_note_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_note_p={!! $job_note_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($job_note_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_note_p={!! $job_note_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_note_p={!! $job_note_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "job_galeries">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Galery Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($jobGaleries as $jobGalery)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('jobTSGaleries.show', [$jobGalery->galery_id]) !!}"> {!! $jobGalery->galery_name !!} </a> </td>
                                        <td> {!! $jobGalery->user_name !!} </td>
                                        <td> {!! $jobGalery->email !!} </td>
                                        <td> {!! $jobGalery->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($job_galery_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_galery_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_galery_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($job_galery_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_galery_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_galery_p={!! $job_galery_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($job_galery_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_galery_p={!! $job_galery_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_galery_p={!! $job_galery_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "job_images">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Image Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($jobImages as $jobImage)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('jobTSGaleryImages.show', [$jobImage->image_id]) !!}"> {!! $jobImage->image_name !!} </a> </td>
                                        <td> {!! $jobImage->user_name !!} </td>
                                        <td> {!! $jobImage->email !!} </td>
                                        <td> {!! $jobImage->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($job_image_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_image_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_image_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($job_image_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_image_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_image_p={!! $job_image_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($job_image_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_image_p={!! $job_image_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_image_p={!! $job_image_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "job_playlists">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Playlist Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($jobPlaylists as $jobPlaylist)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('jobTSPlaylists.show', [$jobPlaylist->playlist_id]) !!}"> {!! $jobPlaylist->playlist_name !!} </a> </td>
                                        <td> {!! $jobPlaylist->user_name !!} </td>
                                        <td> {!! $jobPlaylist->email !!} </td>
                                        <td> {!! $jobPlaylist->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($job_playlist_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_playlist_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_playlist_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($job_playlist_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_playlist_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_playlist_p={!! $job_playlist_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($job_playlist_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_playlist_p={!! $job_playlist_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_playlist_p={!! $job_playlist_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "job_audios">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Audio Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($jobAudios as $jobAudio)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('jobTSPAudios.show', [$jobAudio->audio_id]) !!}"> {!! $jobAudio->audio_name !!} </a> </td>
                                        <td> {!! $jobAudio->user_name !!} </td>
                                        <td> {!! $jobAudio->email !!} </td>
                                        <td> {!! $jobAudio->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($job_audio_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_audio_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_audio_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($job_audio_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_audio_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_audio_p={!! $job_audio_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($job_audio_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_audio_p={!! $job_audio_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_audio_p={!! $job_audio_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "job_tools">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Tool Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($jobTools as $jobTool)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('jobTSTools.show', [$jobTool->tool_id]) !!}"> {!! $jobTool->tool_name !!} </a> </td>
                                        <td> {!! $jobTool->user_name !!} </td>
                                        <td> {!! $jobTool->email !!} </td>
                                        <td> {!! $jobTool->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($job_tool_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_tool_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_tool_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($job_tool_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_tool_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_tool_p={!! $job_tool_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($job_tool_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_tool_p={!! $job_tool_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_tool_p={!! $job_tool_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "job_tool_files">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Tool File Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($jobToolFiles as $jobToolFile)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('jobTSToolFiles.show', [$jobToolFile->tool_id]) !!}"> {!! $jobToolFile->tool_name !!} </a> </td>
                                        <td> {!! $jobToolFile->user_name !!} </td>
                                        <td> {!! $jobToolFile->email !!} </td>
                                        <td> {!! $jobToolFile->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($job_tool_file_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_tool_file_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_tool_file_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($job_tool_file_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_tool_file_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_tool_file_p={!! $job_tool_file_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($job_tool_file_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_tool_file_p={!! $job_tool_file_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?job_tool_file_p={!! $job_tool_file_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
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
                      
                    </div>
                    
                  </div>
                    
                </div>
                  
                <div class = "tab-pane" id = "projects">
                  
                  <div class="box box-primary" style="margin-bottom: 0;">
            
                    <div class="box-body">
                              
                      <div class="row">
                          
                        <div class="col-md-12">
                          
                          <div class="nav-tabs-custom" style="margin-bottom: 0;">
                              
                            <ul class="nav nav-tabs">
                                
                              <li class = "active"><a href="#s_projects" data-toggle="tab"> Projects </a></li>
                              <li><a href="#project_topics" data-toggle="tab"> Topics </a></li>
                              <li><a href="#project_sections" data-toggle="tab"> Sections </a></li>
                              <li><a href="#project_files" data-toggle="tab"> Files </a></li>
                              <li><a href="#project_notes" data-toggle="tab"> Notes </a></li>
                              <li><a href="#project_galeries" data-toggle="tab"> Galeries </a></li>
                              <li><a href="#project_images" data-toggle="tab"> Images </a></li>
                              <li><a href="#project_playlists" data-toggle="tab"> Playlists </a></li>
                              <li><a href="#project_audios" data-toggle="tab"> Audios </a></li>
                              <li><a href="#project_tools" data-toggle="tab"> Tools </a></li>
                              <li><a href="#project_tool_files" data-toggle="tab"> Tool Files </a></li>
                                
                            </ul>
                            
                            <div class="tab-content clearfix">
                              
                              <div class = "tab-pane active" id = "s_projects">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Project Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($projects as $project)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('projects.show', [$project->project_id]) !!}"> {!! $project->project_name !!} </a> </td>
                                        <td> {!! $project->user_name !!} </td>
                                        <td> {!! $project->email !!} </td>
                                        <td> {!! $project->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($project_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($project_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_p={!! $project_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($project_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_p={!! $project_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_p={!! $project_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "project_topics">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Topic Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($projectTopics as $projectTopic)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('projectTopics.show', [$projectTopic->topic_id]) !!}"> {!! $projectTopic->topic_name !!} </a> </td>
                                        <td> {!! $projectTopic->user_name !!} </td>
                                        <td> {!! $projectTopic->email !!} </td>
                                        <td> {!! $projectTopic->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($project_topic_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_topic_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_topic_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($project_topic_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_topic_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_topic_p={!! $project_topic_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($project_topic_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_topic_p={!! $project_topic_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_topic_p={!! $project_topic_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "project_sections">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Section Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($projectSections as $projectSection)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('projectTopicSections.show', [$projectSection->section_id]) !!}"> {!! $projectSection->section_name !!} </a> </td>
                                        <td> {!! $projectSection->user_name !!} </td>
                                        <td> {!! $projectSection->email !!} </td>
                                        <td> {!! $projectSection->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($project_section_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_section_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_section_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($project_section_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_section_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_section_p={!! $project_section_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($project_section_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_section_p={!! $project_section_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_section_p={!! $project_section_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "project_files">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>File Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($projectFiles as $projectFile)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('projectTSFiles.show', [$projectFile->file_id]) !!}"> {!! $projectFile->file_name !!} </a> </td>
                                        <td> {!! $projectFile->user_name !!} </td>
                                        <td> {!! $projectFile->email !!} </td>
                                        <td> {!! $projectFile->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($project_file_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_file_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_file_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($project_file_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_file_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_file_p={!! $project_file_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($project_file_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_file_p={!! $project_file_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_file_p={!! $project_file_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "project_notes">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Note Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($projectNotes as $projectNote)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('projectTSNotes.show', [$projectNote->note_id]) !!}"> {!! $projectNote->note_name !!} </a> </td>
                                        <td> {!! $projectNote->user_name !!} </td>
                                        <td> {!! $projectNote->email !!} </td>
                                        <td> {!! $projectNote->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($project_note_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_note_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_note_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($project_note_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_note_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_note_p={!! $project_note_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($project_note_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_note_p={!! $project_note_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_note_p={!! $project_note_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "project_galeries">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Galery Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($projectGaleries as $projectGalery)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('projectTSGaleries.show', [$projectGalery->galery_id]) !!}"> {!! $projectGalery->galery_name !!} </a> </td>
                                        <td> {!! $projectGalery->user_name !!} </td>
                                        <td> {!! $projectGalery->email !!} </td>
                                        <td> {!! $projectGalery->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($project_galery_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_galery_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_galery_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($project_galery_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_galery_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_galery_p={!! $project_galery_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($project_galery_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_galery_p={!! $project_galery_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_galery_p={!! $project_galery_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "project_images">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Image Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($projectImages as $projectImage)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('projectTSGaleryImages.show', [$projectImage->image_id]) !!}"> {!! $projectImage->image_name !!} </a> </td>
                                        <td> {!! $projectImage->user_name !!} </td>
                                        <td> {!! $projectImage->email !!} </td>
                                        <td> {!! $projectImage->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($project_image_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_image_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_image_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($project_image_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_image_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_image_p={!! $project_image_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($project_image_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_image_p={!! $project_image_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_image_p={!! $project_image_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "project_playlists">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Playlist Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($projectPlaylists as $projectPlaylist)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('projectTSPlaylists.show', [$projectPlaylist->playlist_id]) !!}"> {!! $projectPlaylist->playlist_name !!} </a> </td>
                                        <td> {!! $projectPlaylist->user_name !!} </td>
                                        <td> {!! $projectPlaylist->email !!} </td>
                                        <td> {!! $projectPlaylist->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($project_playlist_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_playlist_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_playlist_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($project_playlist_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_playlist_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_playlist_p={!! $project_playlist_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($project_playlist_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_playlist_p={!! $project_playlist_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_playlist_p={!! $project_playlist_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "project_audios">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Audio Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($projectAudios as $projectAudio)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('projectTSPAudios.show', [$projectAudio->audio_id]) !!}"> {!! $projectAudio->audio_name !!} </a> </td>
                                        <td> {!! $projectAudio->user_name !!} </td>
                                        <td> {!! $projectAudio->email !!} </td>
                                        <td> {!! $projectAudio->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($project_audio_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_audio_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_audio_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($project_audio_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_audio_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_audio_p={!! $project_audio_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($project_audio_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_audio_p={!! $project_audio_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_audio_p={!! $project_audio_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "project_tools">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Tool Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($projectTools as $projectTool)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('projectTSTools.show', [$projectTool->tool_id]) !!}"> {!! $projectTool->tool_name !!} </a> </td>
                                        <td> {!! $projectTool->user_name !!} </td>
                                        <td> {!! $projectTool->email !!} </td>
                                        <td> {!! $projectTool->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($project_tool_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_tool_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_tool_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($project_tool_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_tool_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_tool_p={!! $project_tool_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($project_tool_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_tool_p={!! $project_tool_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_tool_p={!! $project_tool_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "project_tool_files">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Tool File Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($projectToolFiles as $projectToolFile)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('projectTSToolFiles.show', [$projectToolFile->tool_id]) !!}"> {!! $projectToolFile->tool_name !!} </a> </td>
                                        <td> {!! $projectToolFile->user_name !!} </td>
                                        <td> {!! $projectToolFile->email !!} </td>
                                        <td> {!! $projectToolFile->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($project_tool_file_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_tool_file_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_tool_file_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($project_tool_file_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_tool_file_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_tool_file_p={!! $project_tool_file_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($project_tool_file_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_tool_file_p={!! $project_tool_file_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?project_tool_file_p={!! $project_tool_file_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
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
                      
                    </div>
                    
                  </div>
                    
                </div>
                  
                <div class = "tab-pane" id = "personal_datas">
                  
                  <div class="box box-primary" style="margin-bottom: 0;">
            
                    <div class="box-body">
                              
                      <div class="row">
                          
                        <div class="col-md-12">
                          
                          <div class="nav-tabs-custom" style="margin-bottom: 0;">
                              
                            <ul class="nav nav-tabs">
                                
                              <li class = "active"><a href="#s_personal_datas" data-toggle="tab"> Personal Data </a></li>
                              <li><a href="#personal_data_topics" data-toggle="tab"> Topics </a></li>
                              <li><a href="#personal_data_sections" data-toggle="tab"> Sections </a></li>
                              <li><a href="#personal_data_files" data-toggle="tab"> Files </a></li>
                              <li><a href="#personal_data_notes" data-toggle="tab"> Notes </a></li>
                              <li><a href="#personal_data_galeries" data-toggle="tab"> Galeries </a></li>
                              <li><a href="#personal_data_images" data-toggle="tab"> Images </a></li>
                              <li><a href="#personal_data_playlists" data-toggle="tab"> Playlists </a></li>
                              <li><a href="#personal_data_audios" data-toggle="tab"> Audios </a></li>
                              <li><a href="#personal_data_tools" data-toggle="tab"> Tools </a></li>
                              <li><a href="#personal_data_tool_files" data-toggle="tab"> Tool Files </a></li>
                              
                            </ul>
                            
                            <div class="tab-content clearfix">
                              
                              <div class = "tab-pane active" id = "s_personal_datas">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Personal Data Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($personalDatas as $personalData)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('personalDatas.show', [$personalData->personal_data_id]) !!}"> {!! $personalData->personal_data_name !!} </a> </td>
                                        <td> {!! $personalData->user_name !!} </td>
                                        <td> {!! $personalData->email !!} </td>
                                        <td> {!! $personalData->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($personal_data_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($personal_data_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_p={!! $personal_data_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($personal_data_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_p={!! $personal_data_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_p={!! $personal_data_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "personal_data_topics">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Topic Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($personalDataTopics as $personalDataTopic)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('personalDataTopics.show', [$personalDataTopic->topic_id]) !!}"> {!! $personalDataTopic->topic_name !!} </a> </td>
                                        <td> {!! $personalDataTopic->user_name !!} </td>
                                        <td> {!! $personalDataTopic->email !!} </td>
                                        <td> {!! $personalDataTopic->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($personal_data_topic_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_topic_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_topic_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($personal_data_topic_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_topic_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_topic_p={!! $personal_data_topic_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($personal_data_topic_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_topic_p={!! $personal_data_topic_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_topic_p={!! $personal_data_topic_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "personal_data_sections">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Section Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($personalDataSections as $personalDataSection)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('personalDataTopicSections.show', [$personalDataSection->section_id]) !!}"> {!! $personalDataSection->section_name !!} </a> </td>
                                        <td> {!! $personalDataSection->user_name !!} </td>
                                        <td> {!! $personalDataSection->email !!} </td>
                                        <td> {!! $personalDataSection->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($personal_data_section_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_section_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_section_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($personal_data_section_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_section_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_section_p={!! $personal_data_section_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($personal_data_section_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_section_p={!! $personal_data_section_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_section_p={!! $personal_data_section_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "personal_data_files">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>File Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($personalDataFiles as $personalDataFile)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('personalDataTSFiles.show', [$personalDataFile->file_id]) !!}"> {!! $personalDataFile->file_name !!} </a> </td>
                                        <td> {!! $personalDataFile->user_name !!} </td>
                                        <td> {!! $personalDataFile->email !!} </td>
                                        <td> {!! $personalDataFile->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($personal_data_file_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_file_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_file_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($personal_data_file_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_file_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_file_p={!! $personal_data_file_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($personal_data_file_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_file_p={!! $personal_data_file_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_file_p={!! $personal_data_file_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "personal_data_notes">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Note Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($personalDataNotes as $personalDataNote)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('personalDataTSNotes.show', [$personalDataNote->note_id]) !!}"> {!! $personalDataNote->note_name !!} </a> </td>
                                        <td> {!! $personalDataNote->user_name !!} </td>
                                        <td> {!! $personalDataNote->email !!} </td>
                                        <td> {!! $personalDataNote->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($personal_data_note_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_note_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_note_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($personal_data_note_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_note_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_note_p={!! $personal_data_note_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($personal_data_note_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_note_p={!! $personal_data_note_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_note_p={!! $personal_data_note_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "personal_data_galeries">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Galery Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($personalDataGaleries as $personalDataGalery)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('personalDataTSGaleries.show', [$personalDataGalery->galery_id]) !!}"> {!! $personalDataGalery->galery_name !!} </a> </td>
                                        <td> {!! $personalDataGalery->user_name !!} </td>
                                        <td> {!! $personalDataGalery->email !!} </td>
                                        <td> {!! $personalDataGalery->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($personal_data_galery_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_galery_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_galery_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($personal_data_galery_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_galery_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_galery_p={!! $personal_data_galery_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($personal_data_galery_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_galery_p={!! $personal_data_galery_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_galery_p={!! $personal_data_galery_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "personal_data_images">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Image Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($personalDataImages as $personalDataImage)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('personalDataTSGaleryImages.show', [$personalDataImage->image_id]) !!}"> {!! $personalDataImage->image_name !!} </a> </td>
                                        <td> {!! $personalDataImage->user_name !!} </td>
                                        <td> {!! $personalDataImage->email !!} </td>
                                        <td> {!! $personalDataImage->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($personal_data_image_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_image_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_image_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($personal_data_image_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_image_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_image_p={!! $personal_data_image_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($personal_data_image_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_image_p={!! $personal_data_image_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_image_p={!! $personal_data_image_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "personal_data_playlists">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Playlist Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($personalDataPlaylists as $personalDataPlaylist)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('personalDataTSPlaylists.show', [$personalDataPlaylist->playlist_id]) !!}"> {!! $personalDataPlaylist->playlist_name !!} </a> </td>
                                        <td> {!! $personalDataPlaylist->user_name !!} </td>
                                        <td> {!! $personalDataPlaylist->email !!} </td>
                                        <td> {!! $personalDataPlaylist->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($personal_data_playlist_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_playlist_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_playlist_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($personal_data_playlist_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_playlist_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_playlist_p={!! $personal_data_playlist_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($personal_data_playlist_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_playlist_p={!! $personal_data_playlist_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_playlist_p={!! $personal_data_playlist_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "personal_data_audios">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Audio Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($personalDataAudios as $personalDataAudio)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('personalDataTSPAudios.show', [$personalDataAudio->audio_id]) !!}"> {!! $personalDataAudio->audio_name !!} </a> </td>
                                        <td> {!! $personalDataAudio->user_name !!} </td>
                                        <td> {!! $personalDataAudio->email !!} </td>
                                        <td> {!! $personalDataAudio->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($personal_data_audio_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_audio_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_audio_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($personal_data_audio_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_audio_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_audio_p={!! $personal_data_audio_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($personal_data_audio_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_audio_p={!! $personal_data_audio_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_audio_p={!! $personal_data_audio_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "personal_data_tools">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Tool Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($personalDataTools as $personalDataTool)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('personalDataTSTools.show', [$personalDataTool->tool_id]) !!}"> {!! $personalDataTool->tool_name !!} </a> </td>
                                        <td> {!! $personalDataTool->user_name !!} </td>
                                        <td> {!! $personalDataTool->email !!} </td>
                                        <td> {!! $personalDataTool->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($personal_data_tool_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_tool_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_tool_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($personal_data_tool_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_tool_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_tool_p={!! $personal_data_tool_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($personal_data_tool_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_tool_p={!! $personal_data_tool_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_tool_p={!! $personal_data_tool_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
                                    </div>
                                  
                                  </div>
                                  
                                </div>

                    </div>

                  </div> 

                              </div>
                              
                              <div class = "tab-pane" id = "personal_data_tool_files">
                              
                                <div class="row">

                    <div class="col-sm-12">
                      
                      <div class="table-responsive">

                                <table class="table table-responsive">
    
                                  <thead>
                                          
                                    <tr>
                                              
                                      <th>Tool File Name</th>
                                      <th>User Name</th>
                                      <th>User Email</th>
                                      <th>Datetime</th>
                                          
                                    </tr>
                                      
                                  </thead>
                                      
                                  <tbody>
                                      
                                    @foreach($personalDataToolFiles as $personalDataToolFile)
                                      
                                      <tr>
                                        
                                        <td> <a href = "{!! route('personalDataTSToolFiles.show', [$personalDataToolFile->tool_id]) !!}"> {!! $personalDataToolFile->tool_name !!} </a> </td>
                                        <td> {!! $personalDataToolFile->user_name !!} </td>
                                        <td> {!! $personalDataToolFile->email !!} </td>
                                        <td> {!! $personalDataToolFile->datetime !!} </td>
                                        
                                      </tr>
                                      
                                    @endforeach
                                      
                                  </tbody>
                                  
                                </table>

                                </div>
                                
                                <div class="mailbox-controls">
                                
                                  <div class="btn-group">
                                    
                                  </div>
                                  
                                  <div class="pull-right">
                                  
                                    1-50
                                    
                                    <div class="btn-group">
                                      
                                      @if($personal_data_tool_file_p < 1)
                        
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_tool_file_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_tool_file_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                      
                                      @endif
                                      
                                      @if($personal_data_tool_file_p == 1)
                                                  
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_tool_file_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_tool_file_p={!! $personal_data_tool_file_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
              
                                      @endif
                                      
                                      @if($personal_data_tool_file_p > 1)
                                      
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_tool_file_p={!! $personal_data_tool_file_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                                        <a href = "http://www.desmus.com.mx/sharedFiles?personal_data_tool_file_p={!! $personal_data_tool_file_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                                        
                                      @endif
                                      
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
                      
                    </div>
                    
                  </div>
                    
                </div>
                
                <div class = "tab-pane" id = "calendar_events">
                  
                  <div class="box box-primary" style="margin-bottom: 0;">
              
                    <div class="box-body">
                                
                      <div class="row">
                            
                        <div class="col-md-12">
                            
                          <div class="table-responsive">

                            <table class="table table-responsive">
    
                              <thead>
                                          
                                <tr>
                                              
                                  <th>Calendar Event Name</th>
                                  <th>User Name</th>
                                  <th>User Email</th>
                                  <th>Datetime</th>
                                          
                                </tr>
                                      
                              </thead>
                                      
                              <tbody>
                                      
                                @foreach($calendarEvents as $calendarEvent)
                                      
                                  <tr>
                                        
                                    <td> <a href = "{!! route('calendarEvents.show', [$calendarEvent->calendar_event_id]) !!}"> {!! $calendarEvent->calendar_event_name !!} </a> </td>
                                    <td> {!! $calendarEvent->user_name !!} </td>
                                    <td> {!! $calendarEvent->email !!} </td>
                                    <td> {!! $calendarEvent->datetime !!} </td>
                                        
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
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#a_colleges" data-toggle="tab">
        
          <i class="fa fa-graduation-cap"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#a_jobs" data-toggle="tab">
          
          <i class="fa fa-briefcase"></i>
          
        </a>
        
      </li>
      
      <li>
      
        <a href="#a_projects" data-toggle="tab">
          
          <i class="fa fa-folder-open"></i>
          
        </a>
      
      </li>
      
      <li>
      
        <a href="#a_personal_datas" data-toggle="tab">
          
          <i class="fa fa-user"></i>
          
        </a>
      
      </li>
      
      <li>
      
        <a href="#a_calendar_events" data-toggle="tab">
          
          <i class="fa fa-calendar"></i>
          
        </a>
      
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="a_colleges">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Files </h3>
        
        <ul class="control-sidebar-menu">
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-graduation-cap bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Colleges </h4>
                <p> Shared Colleges </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($collegesList as $collegeList)

  							<li> <a href = "{!! route('colleges.show', [$collegeList -> college_id]) !!}"> {!! $collegeList -> college_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-book bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> College Topics </h4>
                <p> Shared Topics </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($collegeTopicsList as $collegeTopicList)

  							<li> <a href = "{!! route('collegeTopics.show', [$collegeTopicList -> topic_id]) !!}"> {!! $collegeTopicList -> topic_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-columns bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> College Sections </h4>
                <p> Shared Sections </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($collegeSectionsList as $collegeSectionList)

  							<li> <a href = "{!! route('collegeTopicSections.show', [$collegeSectionList -> section_id]) !!}"> {!! $collegeSectionList -> section_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> College Files </h4>
                <p> Shared Files </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($collegeFilesList as $collegeFileList)

  							<li> <a href = "{!! route('collegeTSFiles.show', [$collegeFileList -> file_id]) !!}"> {!! $collegeFileList -> file_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-sticky-note bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> College Notes </h4>
                <p> Shared Notes </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($collegeNotesList as $collegeNoteList)

  							<li> <a href = "{!! route('collegeTSNotes.show', [$collegeNoteList -> note_id]) !!}"> {!! $collegeNoteList -> note_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-paint-brush bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> College Galeries </h4>
                <p> Shared Galeries </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($collegeGaleriesList as $collegeGaleryList)

  							<li> <a href = "{!! route('collegeTSGaleries.show', [$collegeGaleryList -> galery_id]) !!}"> {!! $collegeGaleryList -> galery_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file-image-o bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> College Images </h4>
                <p> Shared Images </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($collegeImagesList as $collegeImageList)

  							<li> <a href = "{!! route('collegeTSGaleryImages.show', [$collegeImageList -> image_id]) !!}"> {!! $collegeImageList -> image_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropup">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-headphones  bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> College Playlists </h4>
                <p> Shared Playlists </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($collegePlaylistsList as $collegePlaylistList)

  							<li> <a href = "{!! route('collegeTSPlaylists.show', [$collegePlaylistList -> playlist_id]) !!}"> {!! $collegePlaylistList -> playlist_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropup">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file-audio-o bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> College Audios </h4>
                <p> Shared Audios </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($collegeAudiosList as $collegeAudioList)

  							<li> <a href = "{!! route('collegeTSPAudios.show', [$collegeAudioList -> audio_id]) !!}"> {!! $collegeAudioList -> audio_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropup">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-cog bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> College Tools </h4>
                <p> Shared Tools </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($collegeToolsList as $collegeToolList)

  							<li> <a href = "{!! route('collegeTSTools.show', [$collegeToolList -> tool_id]) !!}"> {!! $collegeToolList -> tool_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropup">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file-code-o bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> College Tool Files </h4>
                <p> Shared Tool Files </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($collegeToolFilesList as $collegeToolFileList)

  							<li> <a href = "{!! route('collegeTSToolFiles.show', [$collegeToolFileList -> tool_id]) !!}"> {!! $collegeToolFileList -> tool_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
            
        </ul>

      </div>
      
      <div class="tab-pane" id="a_jobs">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Files </h3>
        
        <ul class="control-sidebar-menu">
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-briefcase bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Jobs </h4>
                <p> Shared Jobs </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($jobsList as $jobList)

  							<li> <a href = "{!! route('jobs.show', [$jobList -> job_id]) !!}"> {!! $jobList -> job_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-book bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Job Topics </h4>
                <p> Shared Topics </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($jobTopicsList as $jobTopicList)

  							<li> <a href = "{!! route('jobTopics.show', [$jobTopicList -> topic_id]) !!}"> {!! $jobTopicList -> topic_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-columns bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Job Sections </h4>
                <p> Shared Sections </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($jobSectionsList as $jobSectionList)

  							<li> <a href = "{!! route('jobTopicSections.show', [$jobSectionList -> section_id]) !!}"> {!! $jobSectionList -> section_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Job Files </h4>
                <p> Shared Files </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($jobFilesList as $jobFileList)

  							<li> <a href = "{!! route('jobTSFiles.show', [$jobFileList -> file_id]) !!}"> {!! $jobFileList -> file_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-sticky-note bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Job Notes </h4>
                <p> Shared Notes </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($jobNotesList as $jobNoteList)

  							<li> <a href = "{!! route('jobTSNotes.show', [$jobNoteList -> note_id]) !!}"> {!! $jobNoteList -> note_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-paint-brush bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Job Galeries </h4>
                <p> Shared Galeries </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($jobGaleriesList as $jobGaleryList)

  							<li> <a href = "{!! route('jobTSGaleries.show', [$jobGaleryList -> galery_id]) !!}"> {!! $jobGaleryList -> galery_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file-image-o bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Job Images </h4>
                <p> Shared Images </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($jobImagesList as $jobImageList)

  							<li> <a href = "{!! route('jobTSGaleryImages.show', [$jobImageList -> image_id]) !!}"> {!! $jobImageList -> image_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropup">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-headphones  bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Job Playlists </h4>
                <p> Shared Playlists </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($jobPlaylistsList as $jobPlaylistList)

  							<li> <a href = "{!! route('jobTSPlaylists.show', [$jobPlaylistList -> playlist_id]) !!}"> {!! $jobPlaylistList -> playlist_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropup">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file-audio-o bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Job Audios </h4>
                <p> Shared Audios </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($jobAudiosList as $jobAudioList)

  							<li> <a href = "{!! route('jobTSPAudios.show', [$jobAudioList -> audio_id]) !!}"> {!! $jobAudioList -> audio_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropup">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-cog bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Job Tools </h4>
                <p> Shared Tools </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($jobToolsList as $jobToolList)

  							<li> <a href = "{!! route('jobTSTools.show', [$jobToolList -> tool_id]) !!}"> {!! $jobToolList -> tool_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropup">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file-code-o bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Job Tool Files </h4>
                <p> Shared Tool Files </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($jobToolFilesList as $jobToolFileList)

  							<li> <a href = "{!! route('jobTSToolFiles.show', [$jobToolFileList -> tool_id]) !!}"> {!! $jobToolFileList -> tool_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
            
        </ul>

      </div>
      
      <div class="tab-pane" id="a_projects">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Files </h3>
        
        <ul class="control-sidebar-menu">
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-folder bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Projects </h4>
                <p> Shared Projects </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($projectsList as $projectList)

  							<li> <a href = "{!! route('projects.show', [$projectList -> project_id]) !!}"> {!! $projectList -> project_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-book bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Project Topics </h4>
                <p> Shared Topics </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($projectTopicsList as $projectTopicList)

  							<li> <a href = "{!! route('projectTopics.show', [$projectTopicList -> topic_id]) !!}"> {!! $projectTopicList -> topic_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-columns bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Project Sections </h4>
                <p> Shared Sections </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($projectSectionsList as $projectSectionList)

  							<li> <a href = "{!! route('projectTopicSections.show', [$projectSectionList -> section_id]) !!}"> {!! $projectSectionList -> section_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Project Files </h4>
                <p> Shared Files </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($projectFilesList as $projectFileList)

  							<li> <a href = "{!! route('projectTSFiles.show', [$projectFileList -> file_id]) !!}"> {!! $projectFileList -> file_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-sticky-note bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Project Notes </h4>
                <p> Shared Notes </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($projectNotesList as $projectNoteList)

  							<li> <a href = "{!! route('projectTSNotes.show', [$projectNoteList -> note_id]) !!}"> {!! $projectNoteList -> note_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-paint-brush bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Project Galeries </h4>
                <p> Shared Galeries </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($projectGaleriesList as $projectGaleryList)

  							<li> <a href = "{!! route('projectTSGaleries.show', [$projectGaleryList -> galery_id]) !!}"> {!! $projectGaleryList -> galery_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file-image-o bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Project Images </h4>
                <p> Shared Images </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($projectImagesList as $projectImageList)

  							<li> <a href = "{!! route('projectTSGaleryImages.show', [$projectImageList -> image_id]) !!}"> {!! $projectImageList -> image_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropup">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-headphones  bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Project Playlists </h4>
                <p> Shared Playlists </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($projectPlaylistsList as $projectPlaylistList)

  							<li> <a href = "{!! route('projectTSPlaylists.show', [$projectPlaylistList -> playlist_id]) !!}"> {!! $projectPlaylistList -> playlist_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropup">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file-audio-o bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Project Audios </h4>
                <p> Shared Audios </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($projectAudiosList as $projectAudioList)

  							<li> <a href = "{!! route('projectTSPAudios.show', [$projectAudioList -> audio_id]) !!}"> {!! $projectAudioList -> audio_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropup">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-cog bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Project Tools </h4>
                <p> Shared Tools </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($projectToolsList as $projectToolList)

  							<li> <a href = "{!! route('projectTSTools.show', [$projectToolList -> tool_id]) !!}"> {!! $projectToolList -> tool_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropup">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file-code-o bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Project Tool Files </h4>
                <p> Shared Tool Files </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($projectToolFilesList as $projectToolFileList)

  							<li> <a href = "{!! route('projectTSToolFiles.show', [$projectToolFileList -> tool_id]) !!}"> {!! $projectToolFileList -> tool_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
            
        </ul>

      </div>
      
      <div class="tab-pane" id="a_personal_datas">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Files </h3>
        
        <ul class="control-sidebar-menu">
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-user bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Personal Datas </h4>
                <p> Shared Personal Datas </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($personalDatasList as $personalDataList)

  							<li> <a href = "{!! route('personalDatas.show', [$personalDataList -> personal_data_id]) !!}"> {!! $personalDataList -> personal_data_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-book bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Personal Data Topics </h4>
                <p> Shared Topics </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($personalDataTopicsList as $personalDataTopicList)

  							<li> <a href = "{!! route('personalDataTopics.show', [$personalDataTopicList -> topic_id]) !!}"> {!! $personalDataTopicList -> topic_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-columns bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Personal Data Sections </h4>
                <p> Shared Sections </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($personalDataSectionsList as $personalDataSectionList)

  							<li> <a href = "{!! route('personalDataTopicSections.show', [$personalDataSectionList -> section_id]) !!}"> {!! $personalDataSectionList -> section_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Personal Data Files </h4>
                <p> Shared Files </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($personalDataFilesList as $personalDataFileList)

  							<li> <a href = "{!! route('personalDataTSFiles.show', [$personalDataFileList -> file_id]) !!}"> {!! $personalDataFileList -> file_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-sticky-note bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Personal Data Notes </h4>
                <p> Shared Notes </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($personalDataNotesList as $personalDataNoteList)

  							<li> <a href = "{!! route('personalDataTSNotes.show', [$personalDataNoteList -> note_id]) !!}"> {!! $personalDataNoteList -> note_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-paint-brush bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Personal Data Galeries </h4>
                <p> Shared Galeries </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($personalDataGaleriesList as $personalDataGaleryList)

  							<li> <a href = "{!! route('personalDataTSGaleries.show', [$personalDataGaleryList -> galery_id]) !!}"> {!! $personalDataGaleryList -> galery_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file-image-o bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Personal Data Images </h4>
                <p> Shared Images </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($personalDataImagesList as $personalDataImageList)

  							<li> <a href = "{!! route('personalDataTSGaleryImages.show', [$personalDataImageList -> image_id]) !!}"> {!! $personalDataImageList -> image_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropup">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-headphones  bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Personal Data Playlists </h4>
                <p> Shared Playlists </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($personalDataPlaylistsList as $personalDataPlaylistList)

  							<li> <a href = "{!! route('personalDataTSPlaylists.show', [$personalDataPlaylistList -> playlist_id]) !!}"> {!! $personalDataPlaylistList -> playlist_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropup">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file-audio-o bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Personal Data Audios </h4>
                <p> Shared Audios </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($personalDataAudiosList as $personalDataAudioList)

  							<li> <a href = "{!! route('personalDataTSPAudios.show', [$personalDataAudioList -> audio_id]) !!}"> {!! $personalDataAudioList -> audio_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropup">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-cog bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Personal Data Tools </h4>
                <p> Shared Tools </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($personalDataToolsList as $personalDataToolList)

  							<li> <a href = "{!! route('personalDataTSTools.show', [$personalDataToolList -> tool_id]) !!}"> {!! $personalDataToolList -> tool_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropup">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file-code-o bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Personal Data Tool Files </h4>
                <p> Shared Tool Files </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($personalDataToolFilesList as $personalDataToolFileList)

  							<li> <a href = "{!! route('personalDataTSToolFiles.show', [$personalDataToolFileList -> tool_id]) !!}"> {!! $personalDataToolFileList -> tool_name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
            
        </ul>

      </div>
      
      <div class="tab-pane" id="a_calendar_events">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Calendar Events </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($calendarEventsList as $calendarEventList)
            
            <li>
                
              <a href="{!! route('calendarEvents.show', [$calendarEventList -> id]) !!}">
                  
                <i class="menu-icon fa fa-calendar" style="color: {!! $calendarEventList -> color !!}; background: rgba(255,255,255,0.5);"></i>
    
                <div class="menu-info">
                    
                  <h4 class="control-sidebar-subheading"> {!! $calendarEventList -> name !!} </h4>
                  <p> {!! $calendarEventList -> start_date !!} </p>
                  
                </div>
                
              </a>
              
            </li>
            
          @endforeach
            
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection