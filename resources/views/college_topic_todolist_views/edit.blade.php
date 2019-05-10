@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College Topic Todolist View </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTopicTodolistView, ['route' => ['collegeTopicTodolistViews.update', $collegeTopicTodolistView->id], 'method' => 'patch']) !!}

            @include('college_topic_todolist_views.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection