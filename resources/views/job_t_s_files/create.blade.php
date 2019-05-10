@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#job_t_s_file_create').on('submit', function() {
      
      var job_t_s_file_name = document.getElementById("name").value;
      var job_t_s_file_description = document.getElementById("description").value;
      var job_t_s_file_file = document.getElementById("file").value;
      
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
      
      if(job_t_s_file_name == '' || job_t_s_file_description == '' || job_t_s_file_file == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(job_t_s_file_name != '' && job_t_s_file_description == '' || job_t_s_file_file != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> Job Topic Section File </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
          
          <form id = 'job_t_s_file_create' action = "{!! URL::to('/store_job_file') !!}" enctype = "multipart/form-data" method = "post">
            
            {{ csrf_field() }}

            @include('job_t_s_files.create_fields')

          </form>
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#files" data-toggle="tab">
        
          <i class="fa fa-file-o"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="files">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Files </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTSFilesList as $jobTSFileList)
            
              <li>
                
                <a href="{!! route('jobTSFiles.show', [$jobTSFileList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-file-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTSFileList -> name !!} </h4>
                    <p> {!! $jobTSFileList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
    
    </div>
    
  </aside>

@endsection