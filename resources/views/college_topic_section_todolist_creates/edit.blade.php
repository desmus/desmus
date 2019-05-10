@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College Topic Section Todolist Create </h1>
  
  </section>
   
  <div class="content">
    
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTopicSectionTodolistCreate, ['route' => ['collegeTopicSectionTodolistCreates.update', $collegeTopicSectionTodolistCreate->id], 'method' => 'patch']) !!}

            @include('college_topic_section_todolist_creates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection