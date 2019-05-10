@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Personal Data T S G I Todolist Delete </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($personalDataTSGITodolistDelete, ['route' => ['personalDataTSGITodolistDeletes.update', $personalDataTSGITodolistDelete->id], 'method' => 'patch']) !!}

            @include('personal_data_t_s_g_i_todolist_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
    
    </div>
  
  </div>

@endsection