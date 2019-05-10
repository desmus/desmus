@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#personal_data_topic_section_todolist_create').on('submit', function() {
      
      var personal_data_topic_section_todolist_name = document.getElementById("name").value;
      var personal_data_topic_section_todolist_description = document.getElementById("description").value;
      var personal_data_topic_section_todolist_datetime = document.getElementById("datetime").value;
      
      if(personal_data_topic_section_todolist_name == '' || personal_data_topic_section_todolist_description == '' || personal_data_topic_section_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(personal_data_topic_section_todolist_name != '' && personal_data_topic_section_todolist_description != '' && personal_data_topic_section_todolist_datetime != '')
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
        
    <h1> {!!$personalDataTopicSection -> name  !!} </h1>
    
  </section>
    
  <div class="content">
        
    <div class="box box-primary">
            
      <div class="box-body">
                
        <div class="row">
                    
          @include('personal_data_topic_sections.show_fields')
          
          <a href="{!! route('personalDataTopics.show', [$personalDataTopicSection -> personal_data_topic_id]) !!}" class="btn btn-default" style="margin-left: 20px;">Back</a>
          
          @if($user[0] -> id == $user_id)
            
            <a href="{!! route('personalDataTSFiles.create', [$personalDataTopicSection -> id]) !!}" class="btn btn-default">Add File</a>
            <a href="{!! route('personalDataTSNotes.create', [$personalDataTopicSection -> id]) !!}" class="btn btn-default">Add Note</a>
            <a href="{!! route('personalDataTSGaleries.create', [$personalDataTopicSection -> id]) !!}" class="btn btn-default">Add Galery</a>
            <a href="{!! route('personalDataTSPlaylists.create', [$personalDataTopicSection -> id]) !!}" class="btn btn-default">Add Playlist</a>
            <a href="{!! route('personalDataTSTools.create', [$personalDataTopicSection -> id]) !!}" class="btn btn-default">Add Tool</a>
            
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
        
        <a href="#a_personal_data_section_tasks" data-toggle="tab">
        
          <i class="fa fa-list"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#user_personal_data_sections" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#personal_data_section_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#personal_data_section_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="sections">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Section Data </h3>
        
        <ul class="control-sidebar-menu">
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Files </h4>
                <p> Personal Data Files </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($personalDataTSFilesList as $personalDataTSFileList)

  							<li> <a href = "{!! route('personalDataTSFiles.show', [$personalDataTSFileList -> id]) !!}"> {!! $personalDataTSFileList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-sticky-note bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Notes </h4>
                <p> Personal Data Notes </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($personalDataTSNotesList as $personalDataTSNoteList)

  							<li> <a href = "{!! route('personalDataTSNotes.show', [$personalDataTSNoteList -> id]) !!}"> {!! $personalDataTSNoteList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-paint-brush bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Galeries </h4>
                <p> Personal Data Galeries </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($personalDataTSGaleriesList as $personalDataTSGaleryList)

  							<li> <a href = "{!! route('personalDataTSGaleries.show', [$personalDataTSGaleryList -> id]) !!}"> {!! $personalDataTSGaleryList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-headphones bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Playlists </h4>
                <p> Personal Data Playlists </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($personalDataTSPlaylistsList as $personalDataTSPlaylistList)

  							<li> <a href = "{!! route('personalDataTSPlaylists.show', [$personalDataTSPlaylistList -> id]) !!}"> {!! $personalDataTSPlaylistList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-cog bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Tools </h4>
                <p> Personal Data Tools </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($personalDataTSToolsList as $personalDataTSToolList)

  							<li> <a href = "{!! route('personalDataTSTools.show', [$personalDataTSToolList -> id]) !!}"> {!! $personalDataTSToolList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
        
        </ul>

      </div>
      
      <div class="tab-pane" id="a_personal_data_section_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Section Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTopicSectionTodolistsList as $personalDataTopicSectionTodolistList)
            
              <li>
                
                <a href="{!! route('personalDataTSTodolists.show', [$personalDataTopicSectionTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTopicSectionTodolistList -> name !!} </h4>
                    <p> {!! $personalDataTopicSectionTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Section Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($personalDataTopicSectionTodolistsCompletedList as $personalDataTopicSectionTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('personalDataTSTodolists.show', [$personalDataTopicSectionTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $personalDataTopicSectionTodolistCompletedList -> name !!} </h4>
                  <p> {!! $personalDataTopicSectionTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_personal_data_sections">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Personal Data Section Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userPersonalDataTopicSectionsList as $userPersonalDataTopicSectionList)
            
              <li>
                
                <a href="{!! route('userPersonalDataTopicSections.edit', [$userPersonalDataTopicSectionList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userPersonalDataTopicSectionList -> name !!} </h4>
                    <p> {!! $userPersonalDataTopicSectionList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="personal_data_section_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Section Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTopicSectionViewsList as $personalDataTopicSectionViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTopicSectionViewList -> name !!} </h4>
                    <p> {!! $personalDataTopicSectionViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="personal_data_section_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Section Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTopicSectionUpdatesList as $personalDataTopicSectionUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTopicSectionUpdateList -> name !!} </h4>
                    <p> {!! $personalDataTopicSectionUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection