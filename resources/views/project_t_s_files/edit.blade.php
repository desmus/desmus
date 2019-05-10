@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#project_t_s_file_update').on('submit', function() {
      
      var project_t_s_file_name = document.getElementById("name").value;
      var project_t_s_file_description = document.getElementById("description").value;
      
      if(project_t_s_file_name == '' || project_t_s_file_description == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(project_t_s_file_name != '' && project_t_s_file_description != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $projectTSFile->name !!} </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($projectTSFile, ['route' => ['projectTSFiles.update', $projectTSFile->id], 'method' => 'patch', 'id' => 'project_t_s_file_update']) !!}

            @include('project_t_s_files.fields')

          {!! Form::close() !!}
              
        </div>
           
      </div>
      
    </div>
   
   </div>
   
   <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#user_project_files" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#file_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#file_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
      
      <div class="tab-pane active" id="user_project_files">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Project File Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userProjectTSFilesList as $userProjectTSFileList)
            
              <li>
                
                <a href="{!! route('userProjectTSFiles.edit', [$userProjectTSFileList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userProjectTSFileList -> name !!} </h4>
                    <p> {!! $userProjectTSFileList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="file_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project File Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTSFileViewsList as $projectTSFileViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTSFileViewList -> name !!} </h4>
                    <p> {!! $projectTSFileViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="file_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Project File Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($projectTSFileUpdatesList as $projectTSFileUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $projectTSFileUpdateList -> name !!} </h4>
                    <p> {!! $projectTSFileUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection