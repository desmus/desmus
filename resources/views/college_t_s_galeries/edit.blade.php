@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#college_t_s_galery_update').on('submit', function() {
      
      var college_t_s_galery_name = document.getElementById("name").value;
      var college_t_s_galery_description = document.getElementById("description").value;
      
      if(college_t_s_galery_name.length >= 100)
      {
        alert("Invalid character number for the galery name.");
        return false;
      }
      
      if(college_t_s_galery_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(college_t_s_galery_name == '' || college_t_s_galery_description == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(college_t_s_galery_name != '' && college_t_s_galery_description != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $collegeTSGalerie->name !!} </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
      <div class="box box-primary">
   
        <div class="box-body">
          
          <div class="row">
            
            {!! Form::model($collegeTSGalerie, ['route' => ['collegeTSGaleries.update', $collegeTSGalerie->id], 'method' => 'patch', 'id' => 'college_t_s_galery_update']) !!}
            
              @include('college_t_s_galeries.fields')
              
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
        
        <a href="#a_galery_tasks" data-toggle="tab">
        
          <i class="fa fa-list"></i>
        
        </a>
        
      </li>
      
      <li>
        
        <a href="#user_college_galeries" data-toggle="tab">
        
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
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Galery Images </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTSGImagesList as $collegeTSGImageList)
            
              <li>
                
                <a href="{!! route('collegeTSGaleryImages.show', [$collegeTSGImageList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-file-image-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTSGImageList -> name !!} </h4>
                    <p> {!! $collegeTSGImageList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="a_galery_tasks">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Galery Tasks </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTSGaleryTodolistsList as $collegeTSGaleryTodolistList)
            
              <li>
                
                <a href="{!! route('collegeTSGaleryTodolists.show', [$collegeTSGaleryTodolistList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-square-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTSGaleryTodolistList -> name !!} </h4>
                    <p> {!! $collegeTSGaleryTodolistList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
          
        </ul>
          
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Galery Completed Tasks </h3>
        
        <ul class="control-sidebar-menu">
            
          @foreach($collegeTSGaleryTodolistsCompletedList as $collegeTSGaleryTodolistCompletedList)
              
            <li>
                  
              <a href="{!! route('collegeTSGaleryTodolists.show', [$collegeTSGaleryTodolistCompletedList -> id]) !!}">
                    
                <i class="menu-icon fa fa-check-square-o bg-light-blue"></i>
      
                <div class="menu-info">
                      
                  <h4 class="control-sidebar-subheading"> {!! $collegeTSGaleryTodolistCompletedList -> name !!} </h4>
                  <p> {!! $collegeTSGaleryTodolistCompletedList -> created_at !!} </p>
                    
                </div>
                  
              </a>
                
            </li>
              
          @endforeach
          
        </ul>

      </div>
      
      <div class="tab-pane" id="user_college_galeries">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Shared College Galery Users  </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($userCollegeTSGaleriesList as $userCollegeTSGaleryList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-share bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $userCollegeTSGaleryList -> name !!} </h4>
                    <p> {!! $userCollegeTSGaleryList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="galery_views">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Galery Views </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTSGaleryViewsList as $collegeTSGaleryViewList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-eye bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTSGaleryViewList -> name !!} </h4>
                    <p> {!! $collegeTSGaleryViewList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
      <div class="tab-pane" id="galery_updates">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> College Galery Updates </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($collegeTSGaleryUpdatesList as $collegeTSGaleryUpdateList)
            
              <li>
                
                <a href="">
                  
                  <i class="menu-icon fa fa-edit bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $collegeTSGaleryUpdateList -> name !!} </h4>
                    <p> {!! $collegeTSGaleryUpdateList -> datetime !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
      
    </div>
    
  </aside>
   
@endsection