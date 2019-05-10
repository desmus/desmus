@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#user_personal_data_t_s_galery_create').on('submit', function() {
      
      var user_personal_data_t_s_galery_description = document.getElementById("description").value;
      var user_personal_data_t_s_galery_user_id = document.getElementById("user_id").value;
      
      if(user_personal_data_t_s_galery_description.length >= 190)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(user_personal_data_t_s_galery_description == '' || user_personal_data_t_s_galery_user_id == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(user_personal_data_t_s_galery_description != '' || user_personal_data_t_s_galery_user_id == '')
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
                    
          {!! Form::open(['route' => 'userPersonalDataTSGaleries.store', 'id' => 'user_personal_data_t_s_galery_create']) !!}

            @include('user_personal_data_t_s_galeries.create_fields')

          {!! Form::close() !!}
                
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
      
      <li>
        
        <a href="#user_personal_data_galeries" data-toggle="tab">
        
          <i class="fa fa-share"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#galery_views" data-toggle="tab">
        
          <i class="fa fa-eye"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#galery_updates" data-toggle="tab">
        
          <i class="fa fa-edit"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
      
      <div class="tab-pane active" id="images">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Galery Images </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTSGImagesList as $personalDataTSGImageList)
            
              <li>
                
                <a href="{!! route('personalDataTSGaleryImages.show', [$personalDataTSGImageList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-file-image-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTSGImageList -> name !!} </h4>
                    <p> {!! $personalDataTSGImageList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="user_personal_data_galeries">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared Personal Data Galery Users  </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userPersonalDataTSGaleriesList as $userPersonalDataTSGaleryList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userPersonalDataTSGaleryList -> name !!} </h4>
                    <p> {!! $userPersonalDataTSGaleryList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="galery_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Galery Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTSGaleryViewsList as $personalDataTSGaleryViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTSGaleryViewList -> name !!} </h4>
                    <p> {!! $personalDataTSGaleryViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="galery_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Galery Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTSGaleryUpdatesList as $personalDataTSGaleryUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTSGaleryUpdateList -> name !!} </h4>
                    <p> {!! $personalDataTSGaleryUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>
  
@endsection