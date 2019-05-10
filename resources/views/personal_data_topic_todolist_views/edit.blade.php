@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Personal Data Topic Todolist View </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($personalDataTopicTodolistView, ['route' => ['personalDataTopicTodolistViews.update', $personalDataTopicTodolistView->id], 'method' => 'patch']) !!}

            @include('personal_data_topic_todolist_views.fields')

          {!! Form::close() !!}
              
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection