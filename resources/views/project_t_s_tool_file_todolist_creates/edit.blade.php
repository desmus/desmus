@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Project T S Tool File Todolist Create </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($projectTSToolFileTodolistCreate, ['route' => ['projectTSToolFileTodolistCreates.update', $projectTSToolFileTodolistCreate->id], 'method' => 'patch']) !!}

            @include('project_t_s_tool_file_todolist_creates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection