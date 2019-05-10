@extends('layouts.app')

@section('content')
  
  <section class="content-header">
        
    <h1> College Topic Todolist Update </h1>
  
  </section>
  
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTopicTodolistUpdate, ['route' => ['collegeTopicTodolistUpdates.update', $collegeTopicTodolistUpdate->id], 'method' => 'patch']) !!}

            @include('college_topic_todolist_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
    
    </div>
   
  </div>

@endsection