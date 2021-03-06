@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Project T S Note Todolist Delete </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                  
          {!! Form::model($projectTSNoteTodolistDelete, ['route' => ['projectTSNoteTodolistDeletes.update', $projectTSNoteTodolistDelete->id], 'method' => 'patch']) !!}

            @include('project_t_s_note_todolist_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection