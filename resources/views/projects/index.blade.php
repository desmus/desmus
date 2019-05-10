@extends('layouts.app')

@section('scripts')

  <script type="text/javascript">

    $('#topicSearch').on('keyup',function(){
 
      $value=$(this).val();
 
      $.ajax({
 
        type : 'get',
        url : '{{URL::to('ProjectTopicSearch')}}',
        data:{'search':$value},
 
        success:function(data){
          $('tbody#t_topic_search').html(data);
        }
 
      });

    })
 
  </script>

  <script type="text/javascript">

    $('#sectionSearch').on('keyup',function(){
 
      $value=$(this).val();
 
      $.ajax({
 
        type : 'get',
        url : '{{URL::to('ProjectTopicSectionSearch')}}',
        data:{'search':$value},
 
        success:function(data){
          $('tbody#t_section_search').html(data);
        }
 
      });

    })
 
  </script>
 
  <script type="text/javascript">

    $('#fileSearch').on('keyup',function(){
 
      $value=$(this).val();
 
      $.ajax({
 
        type : 'get',
        url : '{{URL::to('ProjectTSFileSearch')}}',
        data:{'search':$value},
 
        success:function(data){
          $('tbody#t_file_search').html(data);
        }
 
      });

    })
 
  </script>

  <script type="text/javascript">

    $('#noteSearch').on('keyup',function(){
 
      $value=$(this).val();
 
      $.ajax({
 
        type : 'get',
        url : '{{URL::to('ProjectTSNoteSearch')}}',
        data:{'search':$value},
 
        success:function(data){
          $('tbody#t_note_search').html(data);
        }
 
      });

    })
 
  </script>

  <script type="text/javascript">

    $('#galerySearch').on('keyup',function(){
 
      $value=$(this).val();
 
      $.ajax({
 
        type : 'get',
        url : '{{URL::to('ProjectTSGalerySearch')}}',
        data:{'search':$value},
 
        success:function(data){
          $('tbody#t_galery_search').html(data);
        }
 
      });

    })
 
  </script>
  
  <script type="text/javascript">

    $('#playlistSearch').on('keyup',function(){
 
      $value=$(this).val();
 
      $.ajax({
 
        type : 'get',
        url : '{{URL::to('ProjectTSPlaylistSearch')}}',
        data:{'search':$value},
 
        success:function(data){
          $('tbody#t_playlist_search').html(data);
        }
 
      });

    })
 
  </script>

  <script type="text/javascript">

    $('#toolSearch').on('keyup',function(){
 
    $value=$(this).val();
 
      $.ajax({
 
        type : 'get',
        url : '{{URL::to('ProjectTSToolSearch')}}',
        data:{'search':$value},
 
        success:function(data){
          $('tbody#t_tool_search').html(data);
        }
 
      });

    })
 
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1 class="pull-left" style="margin-top: 5px;">Projects</h1>
    <h1 class="pull-right" style="margin-top: 10px;"> <a class="btn btn-primary pull-right" style="margin-top: -10px; margin-bottom: 10px" href="{!! route('projects.create') !!}">Add New</a> </h1>
    
  </section>
  
  <div class="content" style = "margin-top: 20px">
    
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    
    <div class="box box-primary">
            
      <div class="box-body">

        <div class="row">
 
          <div class="col-md-12">
          
            <div class="nav-tabs-custom" style="margin-bottom: 0;">
            
              <ul class="nav nav-tabs">

                <li class = "active"><a href="#projects" data-toggle="tab"> Projects </a></li>
                <li><a href="#topic_search" data-toggle="tab"> Topic Search </a></li>
                <li><a href="#section_search" data-toggle="tab"> Section Search </a></li>
                <li><a href="#file_search" data-toggle="tab"> File Search </a></li>
                <li><a href="#note_search" data-toggle="tab"> Note Search </a></li>
                <li><a href="#galery_search" data-toggle="tab"> Galery Search </a></li>
                <li><a href="#playlist_search" data-toggle="tab"> Playlist Search </a></li>
                <li><a href="#tool_search" data-toggle="tab"> Tool Search </a></li>

              </ul>
          
              <div class="tab-content clearfix">
          
                <div class = "tab-pane active" id = "projects">

                  @include('projects.table')
                  
                  <div class="mailbox-controls" style="margin-top: 10px;">
                              
                    <div class="btn-group">
                                  
                    </div>
                                
                    <div class="pull-right">
                                
                      1-50
                                  
                      <div class="btn-group">
                        
                        @if($project_p < 1)
                        
                          <a href = "http://desmus-jmsp.c9users.io/projects?project_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                          <a href = "http://desmus-jmsp.c9users.io/projects?project_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                        
                        @endif
                        
                        @if($project_p == 1)
                                    
                          <a href = "http://desmus-jmsp.c9users.io/projects?project_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                          <a href = "http://desmus-jmsp.c9users.io/projects?project_p={!! $project_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>

                        @endif
                        
                        @if($project_p > 1)
                        
                          <a href = "http://desmus-jmsp.c9users.io/projects?project_p={!! $project_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                          <a href = "http://desmus-jmsp.c9users.io/projects?project_p={!! $project_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                          
                        @endif
                                  
                      </div>
                                
                    </div>
                                
                  </div>

                </div>
                
                <div class = "tab-pane" id = "topic_search">

                  <form action="#" method="get" class="sidebar-form">
                  
                    <input type="text" class="form-control" id = "topicSearch" name = "search" placeholder="Search..."/>
                        
                  </form>
              
                   <table class="table table-responsive" style="margin-bottom: 0;">
                      
                    <thead>
                          
                      <tr>
                             
                        <th>Name</th>
                          
                      </tr>
                      
                    </thead>
                      
                    <tbody id = "t_topic_search">
                
                    </tbody>
                
                  </table>
              
                </div>
              
                <div class = "tab-pane" id = "section_search">
                
                  <form action="#" method="get" class="sidebar-form">
                    
                    <input type="text" class="form-control" id = "sectionSearch" name = "search" placeholder="Search..."/>
                          
                  </form>
                
                  <table class="table table-responsive" style="margin-bottom: 0;">
                      
                    <thead>
                          
                      <tr>
                             
                        <th>Name</th>
                          
                      </tr>
                      
                    </thead>
                      
                    <tbody id = "t_section_search">
                
                    </tbody>
                
                  </table>
                
                </div>
                
                <div class = "tab-pane" id = "file_search">
                
                  <form action="#" method="get" class="sidebar-form">
                    
                    <input type="text" class="form-control" id = "fileSearch" name = "search" placeholder="Search..."/>
                          
                  </form>
                
                  <table class="table table-responsive" style="margin-bottom: 0;">
                      
                    <thead>
                          
                      <tr>
                             
                        <th>Name</th>
                          
                      </tr>
                      
                    </thead>
                      
                    <tbody id = "t_file_search">
                
                    </tbody>
                
                  </table>
                
                </div>
                
                <div class = "tab-pane" id = "note_search">
                
                  <form action="#" method="get" class="sidebar-form">
                    
                    <input type="text" class="form-control" id = "noteSearch" name = "search" placeholder="Search..."/>
                          
                  </form>
                
                  <table class="table table-responsive" style="margin-bottom: 0;">
                      
                    <thead>
                          
                      <tr>
                             
                        <th>Name</th>
                          
                      </tr>
                      
                    </thead>
                      
                    <tbody id = "t_note_search">
                
                    </tbody>
                
                  </table>
                
                </div>
                
                <div class = "tab-pane" id = "galery_search">
                
                  <form action="#" method="get" class="sidebar-form">
                    
                    <input type="text" class="form-control" id = "galerySearch" name = "search" placeholder="Search..."/>
                          
                  </form>
                
                  <table class="table table-responsive" style="margin-bottom: 0;">
                      
                    <thead>
                          
                      <tr>
                             
                        <th>Name</th>
                          
                      </tr>
                      
                    </thead>
                      
                    <tbody id = "t_galery_search">
                
                    </tbody>
                
                  </table>
                
                </div>
                
                <div class = "tab-pane" id = "playlist_search">
              
                  <form action="#" method="get" class="sidebar-form">
                  
                      <input type="text" class="form-control" id = "playlistSearch" name = "search" placeholder="Search..."/>
                        
                  </form>
              
                  <table class="table table-responsive" style="margin-bottom: 0;">
                    
                    <thead>
                        
                      <tr>
                           
                        <th>Name</th>
                        
                      </tr>
                    
                    </thead>
                    
                    <tbody id = "t_playlist_search">
              
                    </tbody>
              
                  </table>
              
                </div>
                
                <div class = "tab-pane" id = "tool_search">
                
                  <form action="#" method="get" class="sidebar-form">
                    
                    <input type="text" class="form-control" id = "toolSearch" name = "search" placeholder="Search..."/>
                          
                  </form>
                
                  <table class="table table-responsive" style="margin-bottom: 0;">
                      
                    <thead>
                          
                      <tr>
                             
                        <th>Name</th>
                          
                      </tr>
                      
                    </thead>
                      
                    <tbody id = "t_tool_search">
                
                    </tbody>
                
                  </table>
                
                </div>
            
              </div>

            </div>
              
          </div>
            
        </div>

      </div>
      
    </div>

    <div class="text-center">
        
    </div>

  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#projects" data-toggle="tab">
        
          <i class="fa fa-graduation-cap"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="projects">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Projects </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projects_list as $project_list)
            
              <li>
                
                <a href="{!! route('projects.show', [$project_list -> id]) !!}">
                  
                  <i class="menu-icon fa fa-graduation-cap bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $project_list -> name !!} </h4>
                    <p> {!! $project_list -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection