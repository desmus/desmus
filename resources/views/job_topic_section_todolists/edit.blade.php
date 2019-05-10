@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#job_topic_section_todolist_update').on('submit', function() {
      
      var job_topic_section_todolist_name = document.getElementById("name").value;
      var job_topic_section_todolist_description = document.getElementById("description").value;
      var job_topic_section_todolist_status = document.getElementById("status").value;
      var job_topic_section_todolist_datetime = document.getElementById("datetime").value;
      
      if(job_topic_section_todolist_name.length >= 100)
      {
        alert("Invalid character number for the task name.");
        return false;
      }
      
      if(job_topic_section_todolist_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(job_topic_section_todolist_name == '' || job_topic_section_todolist_description == '' || job_topic_section_todolist_status == '' || job_topic_section_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(job_topic_section_todolist_name != '' && job_topic_section_todolist_description != '' && job_topic_section_todolist_status != '' && job_topic_section_todolist_datetime != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $jobTopicSectionTodolist -> name !!} </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTopicSectionTodolist, ['route' => ['jobTopicSectionTodolists.update', $jobTopicSectionTodolist->id], 'method' => 'patch', 'id' => 'job_topic_section_todolist_update']) !!}

            @include('job_topic_section_todolists.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection