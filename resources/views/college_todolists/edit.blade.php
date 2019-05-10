@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#college_todolist_update').on('submit', function() {
      
      var college_todolist_name = document.getElementById("name").value;
      var college_todolist_description = document.getElementById("description").value;
      var college_todolist_status = document.getElementById("status").value;
      var college_todolist_datetime = document.getElementById("datetime").value;
      
      if(college_todolist_name.length >= 100)
      {
        alert("Invalid character number for the task name.");
        return false;
      }
      
      if(college_todolist_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(college_todolist_name == '' || college_todolist_description == '' || college_todolist_status == '' || college_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(college_todolist_name != '' && college_todolist_description != '' && college_todolist_status != '' && college_todolist_datetime != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $collegeTodolist -> name !!} </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTodolist, ['route' => ['collegeTodolists.update', $collegeTodolist->id], 'method' => 'patch', 'id' => 'college_todolist_update']) !!}

            @include('college_todolists.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection