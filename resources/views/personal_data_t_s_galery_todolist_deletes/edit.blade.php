@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Personal Data T S Galery Todolist Delete </h1>
  
  </section>
  
  <div class="content">
    
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($personalDataTSGaleryTodolistDelete, ['route' => ['personalDataTSGTodolistDeletes.update', $personalDataTSGaleryTodolistDelete->id], 'method' => 'patch']) !!}

            @include('personal_data_t_s_galery_todolist_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection