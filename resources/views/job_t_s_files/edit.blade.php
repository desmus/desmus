@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#job_t_s_file_update').on('submit', function() {
      
      var job_t_s_file_name = document.getElementById("name").value;
      var job_t_s_file_description = document.getElementById("description").value;
      
      if(job_t_s_file_name.length >= 100)
      {
        alert("Invalid character number for the file name.");
        return false;
      }
      
      if(job_t_s_file_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(job_t_s_file_name == '' || job_t_s_file_description == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(job_t_s_file_name != '' && job_t_s_file_description != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $jobTSFile->name !!} </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTSFile, ['route' => ['jobTSFiles.update', $jobTSFile->id], 'method' => 'patch', 'id' => 'job_t_s_file_update']) !!}

            @include('job_t_s_files.fields')

          {!! Form::close() !!}
              
        </div>
           
      </div>
      
    </div>
   
   </div>
   
   <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#user_job_files" data-toggle="tab">
        
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
      
      <div class="tab-pane active" id="user_job_files">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Job File Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userJobTSFilesList as $userJobTSFileList)
            
              <li>
                
                <a href="{!! route('userJobTSFiles.edit', [$userJobTSFileList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userJobTSFileList -> name !!} </h4>
                    <p> {!! $userJobTSFileList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="file_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job File Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTSFileViewsList as $jobTSFileViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTSFileViewList -> name !!} </h4>
                    <p> {!! $jobTSFileViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="file_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job File Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTSFileUpdatesList as $jobTSFileUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTSFileUpdateList -> name !!} </h4>
                    <p> {!! $jobTSFileUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection