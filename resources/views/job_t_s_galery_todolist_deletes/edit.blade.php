@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job T S Galery Todolist Delete </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTSGaleryTodolistDelete, ['route' => ['jobTSGaleryTodolistDeletes.update', $jobTSGaleryTodolistDelete->id], 'method' => 'patch']) !!}

            @include('job_t_s_galery_todolist_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
    
    </div>
  
  </div>

@endsection