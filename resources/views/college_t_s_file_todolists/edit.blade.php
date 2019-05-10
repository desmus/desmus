@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College T S File Todolist </h1
    
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTSFileTodolist, ['route' => ['collegeTSFileTodolists.update', $collegeTSFileTodolist->id], 'method' => 'patch']) !!}

            @include('college_t_s_file_todolists.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection