@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College T S Galery Todolist View </h1>
  
  </section>
  
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTSGaleryTodolistView, ['route' => ['collegeTSGaleryTodolistViews.update', $collegeTSGaleryTodolistView->id], 'method' => 'patch']) !!}

            @include('college_t_s_galery_todolist_views.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
    
    </div>
  
  </div>

@endsection