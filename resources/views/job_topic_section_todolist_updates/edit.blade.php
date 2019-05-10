@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job Topic Section Todolist Update </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTopicSectionTodolistUpdate, ['route' => ['jobTopicSectionTodolistUpdates.update', $jobTopicSectionTodolistUpdate->id], 'method' => 'patch']) !!}

            @include('job_topic_section_todolist_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection