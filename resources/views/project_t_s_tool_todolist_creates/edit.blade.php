@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> project T S Tool Todolist Create </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($projectTSToolTodolistCreate, ['route' => ['projectTSToolTodolistCreates.update', $projectTSToolTodolistCreate->id], 'method' => 'patch']) !!}

            @include('project_t_s_tool_todolist_creates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection