@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Project Todolist Update </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($projectTodolistUpdate, ['route' => ['projectTodolistUpdates.update', $projectTodolistUpdate->id], 'method' => 'patch']) !!}

            @include('project_todolist_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection