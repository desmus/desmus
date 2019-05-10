@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#user_college_topic_section_create').on('submit', function() {
      
      var user_college_topic_section_description = document.getElementById("description").value;
      var user_college_topic_section_user_id = document.getElementById("user_id").value;
      
      if(user_college_topic_section_description.length >= 190)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(user_college_topic_section_description == '' || user_college_topic_section_user_id == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(user_college_topic_section_description != '' || user_college_topic_section_user_id == '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> Add User </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'userCollegeTopicSections.store', 'id' => 'user_college_topic_section_create']) !!}

            @include('user_college_topic_sections.create_fields')

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