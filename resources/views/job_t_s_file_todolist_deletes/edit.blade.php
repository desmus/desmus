@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job T S File Todolist Delete </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTSFileTodolistDelete, ['route' => ['jobTSFileTodolistDeletes.update', $jobTSFileTodolistDelete->id], 'method' => 'patch']) !!}

            @include('job_t_s_file_todolist_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection