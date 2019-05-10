@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College Topic Todolist Delete </h1>
  
  </section>
   
  <div class="content">
      
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTopicTodolistDelete, ['route' => ['collegeTopicTodolistDeletes.update', $collegeTopicTodolistDelete->id], 'method' => 'patch']) !!}

            @include('college_topic_todolist_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection