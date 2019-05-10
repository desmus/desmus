@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College Todolist Create </h1>
    
  </section>
  
  <div class="content">
    
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          {!! Form::model($collegeTodolistCreate, ['route' => ['collegeTodolistCreates.update', $collegeTodolistCreate->id], 'method' => 'patch']) !!}
          
            @include('college_todolist_creates.fields')
            
          {!! Form::close() !!}
          
        </div>
        
      </div>
      
    </div>
    
  </div>

@endsection