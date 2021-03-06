@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#project_topic_section_update').on('submit', function() {
      
      var project_topic_section_name = document.getElementById("name").value;
      
      if(project_topic_section_name.length >= 100)
      {
        alert("Invalid character number for the section name.");
        return false;
      }
      
      if(project_topic_section_name == '')
      {
        alert("You need to assign a name for the section.");
        return false;
      }
      
      if(project_topic_section_name != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $projectTopicSection->name !!} </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($projectTopicSection, ['route' => ['projectTopicSections.update', $projectTopicSection->id], 'method' => 'patch', 'id' => 'project_topic_section_update']) !!}

            @include('project_topic_sections.fields')

          {!! Form::close() !!}
               
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
        
        <a href="#a_project_section_tasks" data-toggle="tab">
        
          <i class="fa fa-list"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#user_project_sections" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#project_section_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#project_section_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="sections">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Section Data </h3>
        
        <ul class="control-sidebar-menu">
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-file bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Files </h4>
                <p> Project Files </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($projectTSFilesList as $projectTSFileList)

  							<li> <a href = "{!! route('projectTSFiles.show', [$projectTSFileList -> id]) !!}"> {!! $projectTSFileList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-sticky-note bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Notes </h4>
                <p> Project Notes </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($projectTSNotesList as $projectTSNoteList)

  							<li> <a href = "{!! route('projectTSNotes.show', [$projectTSNoteList -> id]) !!}"> {!! $projectTSNoteList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-paint-brush bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Galeries </h4>
                <p> Project Galeries </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($projectTSGaleriesList as $projectTSGaleryList)

  							<li> <a href = "{!! route('projectTSGaleries.show', [$projectTSGaleryList -> id]) !!}"> {!! $projectTSGaleryList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-headphones bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Playlists </h4>
                <p> Project Playlists </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($projectTSPlaylistsList as $projectTSPlaylistList)

  							<li> <a href = "{!! route('projectTSPlaylists.show', [$projectTSPlaylistList -> id]) !!}"> {!! $projectTSPlaylistList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
          
          <li class="dropdown">
                
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
              <i class="menu-icon fa fa-cog bg-light-blue"></i>
    
              <div class="menu-info">
                    
                <h4 class="control-sidebar-subheading"> Tools </h4>
                <p> Project Tools </p>
                  
              </div>
                
            </a>
            
            <ul class = "dropdown-menu" style = "width: 100%;">

              @foreach($projectTSToolsList as $projectTSToolList)

  							<li> <a href = "{!! route('projectTSTools.show', [$projectTSToolList -> id]) !!}"> {!! $projectTSToolList -> name !!} </a> </li>
  							
  						@endforeach

						</ul>
              
          </li>
        
        </ul>

      </div>
      
      <div class="tab-pane" id="a_project_section_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Section Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTopicSectionTodolistsList as $projectTopicSectionTodolistList)
            
              <li>
                
                <a href="{!! route('projectTopicSectionTodolists.show', [$projectTopicSectionTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTopicSectionTodolistList -> name !!} </h4>
                    <p> {!! $projectTopicSectionTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Section Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($projectTopicSectionTodolistsCompletedList as $projectTopicSectionTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('projectTopicSectionTodolists.show', [$projectTopicSectionTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $projectTopicSectionTodolistCompletedList -> name !!} </h4>
                  <p> {!! $projectTopicSectionTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_project_sections">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Project Section Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userProjectTopicSectionsList as $userProjectTopicSectionList)
            
              <li>
                
                <a href="{!! route('userProjectTopicSections.edit', [$userProjectTopicSectionList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userProjectTopicSectionList -> name !!} </h4>
                    <p> {!! $userProjectTopicSectionList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="project_section_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Section Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTopicSectionViewsList as $projectTopicSectionViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTopicSectionViewList -> name !!} </h4>
                    <p> {!! $projectTopicSectionViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="project_section_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project Section Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTopicSectionUpdatesList as $projectTopicSectionUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTopicSectionUpdateList -> name !!} </h4>
                    <p> {!! $projectTopicSectionUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection