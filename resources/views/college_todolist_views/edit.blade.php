@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College Todolist View </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTodolistView, ['route' => ['collegeTodolistViews.update', $collegeTodolistView->id], 'method' => 'patch']) !!}

            @include('college_todolist_views.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection