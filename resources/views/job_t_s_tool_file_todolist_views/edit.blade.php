@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job T S Tool File Todolist View </h1>
  
  </section>
  
  <div class="content">
      
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTSToolFileTodolistView, ['route' => ['jobTSToolFileTodolistViews.update', $jobTSToolFileTodolistView->id], 'method' => 'patch']) !!}

            @include('job_t_s_tool_file_todolist_views.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection