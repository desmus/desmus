@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#college_t_s_g_image_create').on('submit', function() {
      
      var college_t_s_g_image_name = document.getElementById("name").value;
      var college_t_s_g_image_description = document.getElementById("description").value;
      var college_t_s_g_image_file = document.getElementById("image").value;
      var extension = college_t_s_g_image_file.split('.').pop();
      
      if(college_t_s_g_image_name.length >= 100)
      {
        alert("Invalid character number for the image name.");
        return false;
      }
      
      if(college_t_s_g_image_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(college_t_s_g_image_name == '' || college_t_s_g_image_description == '' || college_t_s_g_image_file == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(extension != 'jpg' && extension != 'jpeg' && extension != 'bmp' && extension != 'gif' && extension != 'png')
      {
        alert("The image type must be jpg, jpeg, bmp, gif or png.");
        return false;
      }
      
      if(college_t_s_g_image_name != '' && college_t_s_g_image_description != '' && college_t_s_g_image_file != '' && (extension == 'jpg' || extension == 'jpeg' || extension == 'bmp' || extension == 'gif' || extension == 'png'))
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> College Topic Section Galery Image </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          <form id = 'college_t_s_g_image_create' action = "{!! URL::to('/store_college_image') !!}" enctype = "multipart/form-data" method = "post">
            
            {{ csrf_field() }}

            @include('college_t_s_galery_images.create_fields')

          </form>
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#images" data-toggle="tab">
        
          <i class="fa fa-file-image-o"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="images">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Images </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTSGaleryImagesList as $collegeTSGaleryImageList)
            
              <li>
                
                <a href="{!! route('collegeTSGaleryImages.show', [$collegeTSGaleryImageList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-file-image-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTSGaleryImageList -> name !!} </h4>
                    <p> {!! $collegeTSGaleryImageList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
    
    </div>
    
  </aside>

@endsection