@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job Todolist Delete </h1>
    
  </section>
  
  <div class="content" style = 'margin-top: 20px'>
    
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          {!! Form::open(['route' => 'jobTodolistDeletes.store']) !!}
          
            @include('job_todolist_deletes.fields')
            
          {!! Form::close() !!}
          
        </div>
        
      </div>
      
    </div>
    
    </div>

@endsection