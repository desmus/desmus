@extends('layouts.app')

@section('scripts')

  <script>
    
    $('#personal_data_topic_todolist_update').on('submit', function() {
      
      var personal_data_topic_todolist_name = document.getElementById("name").value;
      var personal_data_topic_todolist_description = document.getElementById("description").value;
      var personal_data_topic_todolist_status = document.getElementById("status").value;
      var personal_data_topic_todolist_datetime = document.getElementById("datetime").value;
      
      if(personal_data_topic_todolist_name.length >= 100)
      {
        alert("Invalid character number for the task name.");
        return false;
      }
      
      if(personal_data_topic_todolist_description.length >= 1000)
      {
        alert("Invalid character number for the description.");
        return false;
      }
      
      if(personal_data_topic_todolist_name == '' || personal_data_topic_todolist_description == '' || personal_data_topic_todolist_status == '' || personal_data_topic_todolist_datetime == '')
      {
        alert("You need to complete all the fields.");
        return false;
      }
      
      if(personal_data_topic_todolist_name != '' && personal_data_topic_todolist_description != '' && personal_data_topic_todolist_status != '' && personal_data_topic_todolist_datetime != '')
      {
        return true;
      }
      
      return false;
      
    });
    
  </script>

@endsection

@section('content')
    
  <section class="content-header">
        
    <h1> {!! $personalDataTopicTodolist -> name !!} </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($personalDataTopicTodolist, ['route' => ['personalDataTopicTodolists.update', $personalDataTopicTodolist->id], 'method' => 'patch', 'id' => 'personal_data_topic_todolist_update']) !!}

            @include('personal_data_topic_todolists.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection