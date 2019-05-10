@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College Topic Section Todolist Update </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTopicSectionTodolistUpdate, ['route' => ['collegeTSTodolistUpdates.update', $collegeTopicSectionTodolistUpdate->id], 'method' => 'patch']) !!}

            @include('college_topic_section_todolist_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection