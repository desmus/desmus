@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job Topic Section Todolist Create </h1>
  
  </section>
   
  <div class="content">
    
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTopicSectionTodolistCreate, ['route' => ['jobTopicSectionTodolistCreates.update', $jobTopicSectionTodolistCreate->id], 'method' => 'patch']) !!}

            @include('job_topic_section_todolist_creates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection