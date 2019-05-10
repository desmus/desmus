@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job Todolist Create </h1>
    
  </section>
  
  <div class="content">
    
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          {!! Form::model($jobTodolistCreate, ['route' => ['jobTodolistCreates.update', $jobTodolistCreate->id], 'method' => 'patch']) !!}
          
            @include('job_todolist_creates.fields')
            
          {!! Form::close() !!}
          
        </div>
        
      </div>
      
    </div>
    
  </div>

@endsection