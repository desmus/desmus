@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#project_topic_section_todolist_create').on('submit', function() {
      
      var project_topic_section_todolist_name = document.getElementById("name").value;
      var project_topic_section_todolist_description = document.getElementById("description").value;
      var project_topic_section_todolist_status = document.getElementById("status").value;
      var project_topic_section_todolist_datetime = document.getElementById("datetime").value;
      
      var date_format = /^(\d{4})-(\d{1,2})-(\d{1,2})$/;
      
      if(project_topic_section_todolist_name.length >= 100)
      {
        alert("Invalid character number for the task name.");
        return false;
      }
      
      if(project_topic_section_todolist_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
  
      if(project_topic_section_todolist_datetime != '')
      {
        if(date_formats = project_topic_section_todolist_datetime.match(date_format))
        {
          if(date_formats[1] < 1902 || date_formats[1] > (new Date()).getFullYear())
          {
            alert("Invalid value for year: " + date_formats[3] + " - must be between 1902 and " + (new Date()).getFullYear());
            return false;
          }
          
          if(date_formats[2] < 1 || date_formats[2] > 12)
          {
            alert("Invalid value for month: " + date_formats[2]);
            return false;
          }
          
          if(date_formats[3] < 1 || date_formats[3] > 31)
          {
            alert("Invalid value for day: " + date_format[1]);
            return false;
          }
        } 
        
        else
        {
          alert("Invalid date format: " + project_topic_section_todolist_datetime);
          return false;
        }
      }
      
      if(project_topic_section_todolist_name == '' || project_topic_section_todolist_description == '' || project_topic_section_todolist_status == '' || project_topic_section_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(project_topic_section_todolist_name != '' && project_topic_section_todolist_description != '' && project_topic_section_todolist_status != '' && project_topic_section_todolist_datetime != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> Project Topic Section Todolist </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
              
        <div class="row">
                    
          {!! Form::open(['route' => 'projectTopicSectionTodolists.store', 'id' => 'project_topic_section_todolist_create']) !!}

            @include('project_topic_section_todolists.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection