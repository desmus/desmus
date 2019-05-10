@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College T S Tool File Todolist Update </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTSToolFileTodolistUpdate, ['route' => ['collegeTSToolFileTodolistUpdates.update', $collegeTSToolFileTodolistUpdate->id], 'method' => 'patch']) !!}

            @include('college_t_s_tool_file_todolist_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection