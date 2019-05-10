@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#job_topic_section_todolist_create').on('submit', function() {
      
      var job_topic_section_todolist_name = document.getElementById("name").value;
      var job_topic_section_todolist_description = document.getElementById("description").value;
      var job_topic_section_todolist_datetime = document.getElementById("datetime").value;
      
      if(job_topic_section_todolist_name == '' || job_topic_section_todolist_description == '' || job_topic_section_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(job_topic_section_todolist_name != '' && job_topic_section_todolist_description != '' && job_topic_section_todolist_datetime != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

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

@section('content')
    
  <section class="content-header">
        
    <h1> {!!$jobTopicSection -> name  !!} </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row">
                    
          @include('job_topic_sections.show_fields')
          <a href="{!! route('jobTopics.show', [$jobTopicSection -> job_topic_id]) !!}" class="btn btn-default" style="margin-left: 20px">Back</a>
          
          @if($user[0] -> id == $user_id)
          
            <a href="{!! route('jobTSFiles.create', [$jobTopicSection -> id]) !!}" class="btn btn-default">Add File</a>
            <a href="{!! route('jobTSNotes.create', [$jobTopicSection -> id]) !!}" class="btn btn-default">Add Note</a>
            <a href="{!! route('jobTSGaleries.create', [$jobTopicSection -> id]) !!}" class="btn btn-default">Add Galery</a>
            <a href="{!! route('jobTSPlaylists.create', [$jobTopicSection -> id]) !!}" class="btn btn-default">Add Playlist</a>
            <a href="{!! route('jobTSTools.create', [$jobTopicSection -> id]) !!}" class="btn btn-default">Add Tool</a>
            
          @endif
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#sections" data-toggle="tab">
        
          <i class="fa fa-files-o"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#a_job_section_tasks" data-toggle="tab">
        
          <i class="fa fa-list"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#user_job_sections" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#job_section_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#job_section_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="sections">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Section Data </h3>
        
        <ul class="control-sidebar-menu">
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Files </h4>
                <p> Job Files </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($jobTSFilesList as $jobTSFileList)

  							<li> <a href = "{!! route('jobTSFiles.show', [$jobTSFileList -> id]) !!}"> {!! $jobTSFileList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-sticky-note bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Notes </h4>
                <p> Job Notes </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($jobTSNotesList as $jobTSNoteList)

  							<li> <a href = "{!! route('jobTSNotes.show', [$jobTSNoteList -> id]) !!}"> {!! $jobTSNoteList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-paint-brush bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Galeries </h4>
                <p> Job Galeries </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($jobTSGaleriesList as $jobTSGaleryList)

  							<li> <a href = "{!! route('jobTSGaleries.show', [$jobTSGaleryList -> id]) !!}"> {!! $jobTSGaleryList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-headphones bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Playlists </h4>
                <p> Job Playlists </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($jobTSPlaylistsList as $jobTSPlaylistList)

  							<li> <a href = "{!! route('jobTSPlaylists.show', [$jobTSPlaylistList -> id]) !!}"> {!! $jobTSPlaylistList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-cog bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Tools </h4>
                <p> Job Tools </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($jobTSToolsList as $jobTSToolList)

  							<li> <a href = "{!! route('jobTSTools.show', [$jobTSToolList -> id]) !!}"> {!! $jobTSToolList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
        
        </ul>

      </div>
      
      <div class="tab-pane" id="a_job_section_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Section Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTopicSectionTodolistsList as $jobTopicSectionTodolistList)
            
              <li>
                
                <a href="{!! route('jobTopicSectionTodolists.show', [$jobTopicSectionTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTopicSectionTodolistList -> name !!} </h4>
                    <p> {!! $jobTopicSectionTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Section Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($jobTopicSectionTodolistsCompletedList as $jobTopicSectionTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('jobTopicSectionTodolists.show', [$jobTopicSectionTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $jobTopicSectionTodolistCompletedList -> name !!} </h4>
                  <p> {!! $jobTopicSectionTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_job_sections">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Job Section Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userJobTopicSectionsList as $userJobTopicSectionList)
            
              <li>
                
                <a href="{!! route('userJobTopicSections.edit', [$userJobTopicSectionList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userJobTopicSectionList -> name !!} </h4>
                    <p> {!! $userJobTopicSectionList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="job_section_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Section Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTopicSectionViewsList as $jobTopicSectionViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTopicSectionViewList -> name !!} </h4>
                    <p> {!! $jobTopicSectionViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="job_section_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Section Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTopicSectionUpdatesList as $jobTopicSectionUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTopicSectionUpdateList -> name !!} </h4>
                    <p> {!! $jobTopicSectionUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection