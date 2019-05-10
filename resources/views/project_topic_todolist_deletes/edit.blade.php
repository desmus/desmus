@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Project Topic Todolist Delete </h1>
  
  </section>
   
  <div class="content">
      
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($projectTopicTodolistDelete, ['route' => ['projectTopicTodolistDeletes.update', $projectTopicTodolistDelete->id], 'method' => 'patch']) !!}

            @include('project_topic_todolist_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection