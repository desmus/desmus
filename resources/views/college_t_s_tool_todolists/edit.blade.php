@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#college_t_s_tool_todolist_update').on('submit', function() {
      
      var college_t_s_tool_todolist_name = document.getElementById("name").value;
      var college_t_s_tool_todolist_description = document.getElementById("description").value;
      var college_t_s_tool_todolist_status = document.getElementById("status").value;
      var college_t_s_tool_todolist_datetime = document.getElementById("datetime").value;
      
      if(college_t_s_tool_todolist_name.length >= 100)
      {
        alert("Invalid character number for the task name.");
        return false;
      }
      
      if(college_t_s_tool_todolist_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(college_t_s_tool_todolist_name == '' || college_t_s_tool_todolist_description == '' || college_t_s_tool_todolist_status == '' || college_t_s_tool_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(college_t_s_tool_todolist_name != '' && college_t_s_tool_todolist_description != '' && college_t_s_tool_todolist_status != '' && college_t_s_tool_todolist_datetime != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $collegeTSToolTodolist -> name !!} </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTSToolTodolist, ['route' => ['collegeTSToolTodolists.update', $collegeTSToolTodolist->id], 'method' => 'patch', 'id' => 'college_t_s_tool_todolist_update']) !!}

            @include('college_t_s_tool_todolists.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection