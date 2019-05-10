@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#user_personal_data_t_s_g_image_create').on('submit', function() {
      
      var user_personal_data_t_s_g_image_description = document.getElementById("description").value;
      var user_personal_data_t_s_g_image_user_id = document.getElementById("user_id").value;
      
      if(user_personal_data_t_s_g_image_description.length >= 190)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(user_personal_data_t_s_g_image_description == '' || user_personal_data_t_s_g_image_user_id == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(user_personal_data_t_s_g_image_description != '' || user_personal_data_t_s_g_image_user_id == '')
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
                    
          {!! Form::open(['route' => 'userPersonalDataTSGaleryImages.store', 'id' => 'user_personal_data_t_s_g_image_create']) !!}

            @include('user_personal_data_t_s_galery_images.create_fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#user_personal_data_images" data-toggle="tab">
        
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
      
      <div class="tab-pane active" id="user_personal_data_images">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Personal Data Image Users </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userPersonalDataTSGImagesList as $userPersonalDataTSGImageList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userPersonalDataTSGImageList -> name !!} </h4>
                    <p> {!! $userPersonalDataTSGImageList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="image_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Image Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTSGaleryImageViewsList as $personalDataTSGaleryImageViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTSGaleryImageViewList -> name !!} </h4>
                    <p> {!! $personalDataTSGaleryImageViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="image_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Image Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTSGaleryImageUpdatesList as $personalDataTSGaleryImageUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTSGaleryImageUpdateList -> name !!} </h4>
                    <p> {!! $personalDataTSGaleryImageUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>
  
@endsection