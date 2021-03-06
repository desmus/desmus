@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#job_t_s_g_image_update').on('submit', function() {
      
      var job_t_s_g_image_name = document.getElementById("name").value;
      var job_t_s_g_image_description = document.getElementById("description").value;
      
      if(job_t_s_g_image_name.length >= 100)
      {
        alert("Invalid character number for the image name.");
        return false;
      }
      
      if(job_t_s_g_image_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(job_t_s_g_image_name == '' || job_t_s_g_image_description == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(job_t_s_g_image_name != '' && job_t_s_g_image_description != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $jobTSGaleryImage->name !!} </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTSGaleryImage, ['route' => ['jobTSGaleryImages.update', $jobTSGaleryImage->id], 'method' => 'patch', 'id' => 'job_t_s_g_image_update']) !!}
            
            @include('job_t_s_galery_images.fields')
            
          {!! Form::close() !!}
            
        </div>
          
      </div>
    
    </div>
  
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#user_job_images" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
        
      <li>
        
        <a href="#image_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#image_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
      
      <div class="tab-pane active" id="user_job_images">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Job Image Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userJobTSGImagesList as $userJobTSGImageList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userJobTSGImageList -> name !!} </h4>
                    <p> {!! $userJobTSGImageList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="image_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Image Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTSGaleryImageViewsList as $jobTSGaleryImageViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTSGaleryImageViewList -> name !!} </h4>
                    <p> {!! $jobTSGaleryImageViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="image_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Job Image Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($jobTSGaleryImageUpdatesList as $jobTSGaleryImageUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $jobTSGaleryImageUpdateList -> name !!} </h4>
                    <p> {!! $jobTSGaleryImageUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>

@endsection