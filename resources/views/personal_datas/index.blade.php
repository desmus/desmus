@extends('layouts.app')

@section('scripts')

  <script type="text/javascript">

    $('#topicSearch').on('keyup',function(){
 
      $value=$(this).val();
 
      $.ajax({
 
        type : 'get',
        url : '{{URL::to('PersonalDataTopicSearch')}}',
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
        url : '{{URL::to('PersonalDataTopicSectionSearch')}}',
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
        url : '{{URL::to('PersonalDataTSFileSearch')}}',
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
        url : '{{URL::to('PersonalDataTSNoteSearch')}}',
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
        url : '{{URL::to('PersonalDataTSGalerySearch')}}',
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
        url : '{{URL::to('PersonalDataTSPlaylistSearch')}}',
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
        url : '{{URL::to('PersonalDataTSToolSearch')}}',
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
        
    <h1 class="pull-left" style="margin-top: 5px;">Personal Data</h1>
    <h1 class="pull-right" style="margin-top: 10px;"> <a class="btn btn-primary pull-right" style="margin-top: -10px; margin-bottom: 10px" href="{!! route('personalDatas.create') !!}">Add New</a> </h1>
    
  </section>
  
  <div class="content" style = 'margin-top: 20px'>
    
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    
    <div class="box box-primary">
            
      <div class="box-body">

        <div class="row">
 
          <div class="col-md-12">
          
            <div class="nav-tabs-custom" style="margin-bottom: 0;">
            
              <ul class="nav nav-tabs">

                <li class = "active"><a href="#personal_datas" data-toggle="tab"> Personal Datas </a></li>
                <li><a href="#topic_search" data-toggle="tab"> Topic Search </a></li>
                <li><a href="#section_search" data-toggle="tab"> Section Search </a></li>
                <li><a href="#file_search" data-toggle="tab"> File Search </a></li>
                <li><a href="#note_search" data-toggle="tab"> Note Search </a></li>
                <li><a href="#galery_search" data-toggle="tab"> Galery Search </a></li>
                <li><a href="#playlist_search" data-toggle="tab"> Playlist Search </a></li>
                <li><a href="#tool_search" data-toggle="tab"> Tool Search </a></li>

              </ul>
          
              <div class="tab-content clearfix">
          
                <div class = "tab-pane active" id = "personal_datas">

                  @include('personal_datas.table')
                  
                  <div class="mailbox-controls" style="margin-top: 10px;">
                              
                    <div class="btn-group">
                                  
                    </div>
                                
                    <div class="pull-right">
                                
                      1-50
                                  
                      <div class="btn-group">
                                    
                        @if($personal_data_p < 1)
                        
                          <a href = "http://desmus-jmsp.c9users.io/personalDatas?personal_data_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                          <a href = "http://desmus-jmsp.c9users.io/personalDatas?personal_data_p=2" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                        
                        @endif
                        
                        @if($personal_data_p == 1)
                                    
                          <a href = "http://desmus-jmsp.c9users.io/personalDatas?personal_data_p=1" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                          <a href = "http://desmus-jmsp.c9users.io/personalDatas?personal_data_p={!! $personal_data_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>

                        @endif
                        
                        @if($personal_data_p > 1)
                        
                          <a href = "http://desmus-jmsp.c9users.io/personalDatas?personal_data_p={!! $personal_data_p - 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                          <a href = "http://desmus-jmsp.c9users.io/personalDatas?personal_data_p={!! $personal_data_p + 1 !!}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                          
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
        
        <a href="#personal_datas" data-toggle="tab">
        
          <i class="fa fa-user"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="personal_datas">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Datas </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personal_datas_list as $personal_data_list)
            
              <li>
                
                <a href="{!! route('personalDatas.show', [$personal_data_list -> id]) !!}">
                  
                  <i class="menu-icon fa fa-user bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personal_data_list -> name !!} </h4>
                    <p> {!! $personal_data_list -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection