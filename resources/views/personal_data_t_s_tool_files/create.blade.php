@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#personal_data_t_s_tool_file_create').on('submit', function() {
      
      var personal_data_t_s_tool_file_name = document.getElementById("name").value;
      var personal_data_t_s_tool_file_description = document.getElementById("description").value;
      var personal_data_t_s_tool_file_file = document.getElementById("file").value;
      var extension = personal_data_t_s_tool_file_file.split('.').pop();
      
      if(personal_data_t_s_tool_file_name.length >= 100)
      {
        alert("Invalid character number for the file name.");
        return false;
      }
      
      if(personal_data_t_s_tool_file_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(personal_data_t_s_tool_file_name == '' || personal_data_t_s_tool_file_description == '' || personal_data_t_s_tool_file_file == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(extension != 'php' && extension != 'js' && extension != 'css' && extension != 'html')
      {
        alert("The file type must be php, js, css, or html.");
        return false;
      }
      
      if(personal_data_t_s_tool_file_name != '' && personal_data_t_s_tool_file_description != '' && personal_data_t_s_tool_file_file != '' && (extension == 'php' || extension == 'js' || extension == 'css' || extension == 'html'))
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
    
    <h1> Personal Data Topic Section Tool File </h1>
  
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          <form id = 'personal_data_t_s_tool_file_create' action = "{!! URL::to('/store_personal_data_tool') !!}" enctype = "multipart/form-data" method = "post">
            
            {{ csrf_field() }}

              @include('personal_data_t_s_tool_files.create_fields')

          </form>
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
  <aside class="control-sidebar control-sidebar-dark control-sidebar-close" style="background: rgba(0,0,0,0.8);">
  
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      <li class="active">
        
        <a href="#audios" data-toggle="tab">
        
          <i class="fa fa-file-code-o"></i>
        
        </a>
        
      </li>
    
    </ul>
    
    <div class="tab-content" style="padding: 20px;">
    
      <div class="tab-pane active" id="galeries">
        
        <h3 class="control-sidebar-heading" style="margin-top: 0; border-bottom: 1px solid rgba(255,255,255,0.3);"> Personal Data Tool Files </h3>
        
        <ul class="control-sidebar-menu">
          
          @foreach($personalDataTSToolFilesList as $personalDataTSToolFileList)
            
              <li>
                
                <a href="{!! route('personalDataTSToolFiles.show', [$personalDataTSToolFileList -> id]) !!}">
                  
                  <i class="menu-icon fa fa-file-code-o bg-light-blue"></i>
    
                  <div class="menu-info">
                    
                    <h4 class="control-sidebar-subheading"> {!! $personalDataTSToolFileList -> name !!} </h4>
                    <p> {!! $personalDataTSToolFileList -> created_at !!} </p>
                  
                  </div>
                
                </a>
              
              </li>
            
          @endforeach
        
        </ul>

      </div>
    
    </div>
    
  </aside>
  
@endsection