@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Project T S G Image Todolist View </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($projectTSGImageTodolistView, ['route' => ['projectTSGImageTodolistViews.update', $projectTSGImageTodolistView->id], 'method' => 'patch']) !!}

            @include('project_t_s_g_image_todolist_views.fields')

          {!! Form::close() !!}
        
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection