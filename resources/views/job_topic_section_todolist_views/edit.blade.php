@extends('layouts.app')

@section('content')
  
  <section class="content-header">
        
    <h1> Job Topic Section Todolist View </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTopicSectionTodolistView, ['route' => ['jobTopicSectionTodolistViews.update', $jobTopicSectionTodolistView->id], 'method' => 'patch']) !!}

            @include('job_topic_section_todolist_views.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
      
    </div>
  
  </div>

@endsection