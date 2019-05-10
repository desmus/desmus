@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#college_topic_section_todolist_create').on('submit', function() {
      
      var college_topic_section_todolist_name = document.getElementById("name").value;
      var college_topic_section_todolist_description = document.getElementById("description").value;
      var college_topic_section_todolist_datetime = document.getElementById("datetime").value;
      
      if(college_topic_section_todolist_name == '' || college_topic_section_todolist_description == '' || college_topic_section_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(college_topic_section_todolist_name != '' && college_topic_section_todolist_description != '' && college_topic_section_todolist_datetime != '')
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
        
    <h1> {!!$collegeTopicSection -> name  !!} </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row">
                    
          @include('college_topic_sections.show_fields')
          <a href="{!! route('collegeTopics.show', [$collegeTopicSection -> college_topic_id]) !!}" class="btn btn-default" style="margin-left: 20px">Back</a>
          
          @if($user[0] -> id == $user_id)
          
            <a href="{!! route('collegeTSFiles.create', [$collegeTopicSection -> id]) !!}" class="btn btn-default">Add File</a>
            <a href="{!! route('collegeTSNotes.create', [$collegeTopicSection -> id]) !!}" class="btn btn-default">Add Note</a>
            <a href="{!! route('collegeTSGaleries.create', [$collegeTopicSection -> id]) !!}" class="btn btn-default">Add Galery</a>
            <a href="{!! route('collegeTSPlaylists.create', [$collegeTopicSection -> id]) !!}" class="btn btn-default">Add Playlist</a>
            <a href="{!! route('collegeTSTools.create', [$collegeTopicSection -> id]) !!}" class="btn btn-default">Add Tool</a>
            
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
        
        <a href="#a_college_section_tasks" data-toggle="tab">
        
          <i class="fa fa-list"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#user_college_sections" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#college_section_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#college_section_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="sections">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Section Data </h3>
        
        <ul class="control-sidebar-menu">
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Files </h4>
                <p> College Files </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($collegeTSFilesList as $collegeTSFileList)

  							<li> <a href = "{!! route('collegeTSFiles.show', [$collegeTSFileList -> id]) !!}"> {!! $collegeTSFileList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-sticky-note bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Notes </h4>
                <p> College Notes </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($collegeTSNotesList as $collegeTSNoteList)

  							<li> <a href = "{!! route('collegeTSNotes.show', [$collegeTSNoteList -> id]) !!}"> {!! $collegeTSNoteList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-paint-brush bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Galeries </h4>
                <p> College Galeries </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($collegeTSGaleriesList as $collegeTSGaleryList)

  							<li> <a href = "{!! route('collegeTSGaleries.show', [$collegeTSGaleryList -> id]) !!}"> {!! $collegeTSGaleryList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-headphones bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Playlists </h4>
                <p> College Playlists </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($collegeTSPlaylistsList as $collegeTSPlaylistList)

  							<li> <a href = "{!! route('collegeTSPlaylists.show', [$collegeTSPlaylistList -> id]) !!}"> {!! $collegeTSPlaylistList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-cog bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Tools </h4>
                <p> College Tools </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($collegeTSToolsList as $collegeTSToolList)

  							<li> <a href = "{!! route('collegeTSTools.show', [$collegeTSToolList -> id]) !!}"> {!! $collegeTSToolList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
        
        </ul>

      </div>
      
      <div class="tab-pane" id="a_college_section_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Section Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTopicSectionTodolistsList as $collegeTopicSectionTodolistList)
            
              <li>
                
                <a href="{!! route('collegeTopicSectionTodolists.show', [$collegeTopicSectionTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTopicSectionTodolistList -> name !!} </h4>
                    <p> {!! $collegeTopicSectionTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Section Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($collegeTopicSectionTodolistsCompletedList as $collegeTopicSectionTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('collegeTopicSectionTodolists.show', [$collegeTopicSectionTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $collegeTopicSectionTodolistCompletedList -> name !!} </h4>
                  <p> {!! $collegeTopicSectionTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_college_sections">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared College Section Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userCollegeTopicSectionsList as $userCollegeTopicSectionList)
            
              <li>
                
                <a href="{!! route('userCollegeTopicSections.edit', [$userCollegeTopicSectionList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userCollegeTopicSectionList -> name !!} </h4>
                    <p> {!! $userCollegeTopicSectionList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="college_section_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Section Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTopicSectionViewsList as $collegeTopicSectionViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTopicSectionViewList -> name !!} </h4>
                    <p> {!! $collegeTopicSectionViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="college_section_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Section Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTopicSectionUpdatesList as $collegeTopicSectionUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTopicSectionUpdateList -> name !!} </h4>
                    <p> {!! $collegeTopicSectionUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection