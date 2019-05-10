@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#user_job_topic_section_update').on('submit', function() {
      
      var user_job_topic_section_permissions = document.getElementById("permissions").value;
      
      if(user_job_topic_section_permissions == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(user_job_topic_section_permissions != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!!$userJobTopicSection[0] -> name !!} </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userJobTopicSection, ['route' => ['userJobTopicSections.update', $userJobTopicSection[0]->id], 'method' => 'patch', 'id' => 'user_job_topic_section_update']) !!}

            @include('user_job_topic_sections.fields')

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