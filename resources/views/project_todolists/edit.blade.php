@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#project_todolist_update').on('submit', function() {
      
      var project_todolist_name = document.getElementById("name").value;
      var project_todolist_description = document.getElementById("description").value;
      var project_todolist_status = document.getElementById("status").value;
      var project_todolist_datetime = document.getElementById("datetime").value;
      
      if(project_todolist_name.length >= 100)
      {
        alert("Invalid character number for the task name.");
        return false;
      }
      
      if(project_todolist_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(project_todolist_name == '' || project_todolist_description == '' || project_todolist_status == '' || project_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(project_todolist_name != '' && project_todolist_description != '' && project_todolist_status != '' && project_todolist_datetime != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $projectTodolist -> name !!} </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($projectTodolist, ['route' => ['projectTodolists.update', $projectTodolist->id], 'method' => 'patch', 'id' => 'project_todolist_update']) !!}

            @include('project_todolists.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection