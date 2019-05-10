@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#job_todolist_update').on('submit', function() {
      
      var job_todolist_name = document.getElementById("name").value;
      var job_todolist_description = document.getElementById("description").value;
      var job_todolist_status = document.getElementById("status").value;
      var job_todolist_datetime = document.getElementById("datetime").value;
      
      if(job_todolist_name.length >= 100)
      {
        alert("Invalid character number for the task name.");
        return false;
      }
      
      if(job_todolist_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }

      if(job_todolist_name == '' || job_todolist_description == '' || job_todolist_status == '' || job_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(job_todolist_name != '' && job_todolist_description != '' && job_todolist_status != '' && job_todolist_datetime != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $jobTodolist -> name !!} </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTodolist, ['route' => ['jobTodolists.update', $jobTodolist->id], 'method' => 'patch', 'id' => 'job_todolist_update']) !!}

            @include('job_todolists.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection