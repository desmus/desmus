@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#job_t_s_galery_todolist_update').on('submit', function() {
      
      var job_t_s_galery_todolist_name = document.getElementById("name").value;
      var job_t_s_galery_todolist_description = document.getElementById("description").value;
      var job_t_s_galery_todolist_status = document.getElementById("status").value;
      var job_t_s_galery_todolist_datetime = document.getElementById("datetime").value;
      
      if(job_t_s_galery_todolist_name.length >= 100)
      {
        alert("Invalid character number for the task name.");
        return false;
      }
      
      if(job_t_s_galery_todolist_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(job_t_s_galery_todolist_name == '' || job_t_s_galery_todolist_description == '' || job_t_s_galery_todolist_status == '' || job_t_s_galery_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(job_t_s_galery_todolist_name != '' && job_t_s_galery_todolist_description != '' && job_t_s_galery_todolist_status != '' && job_t_s_galery_todolist_datetime != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $jobTSGaleryTodolist -> name !!} </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTSGaleryTodolist, ['route' => ['jobTSGaleryTodolists.update', $jobTSGaleryTodolist->id], 'method' => 'patch', 'id' => 'job_t_s_galery_todolist_update']) !!}

            @include('job_t_s_galery_todolists.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection