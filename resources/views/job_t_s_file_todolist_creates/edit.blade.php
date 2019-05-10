@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job T S File Todolist Create </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTSFileTodolistCreate, ['route' => ['jobTSFileTodolistCreates.update', $jobTSFileTodolistCreate->id], 'method' => 'patch']) !!}

            @include('job_t_s_file_todolist_creates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection