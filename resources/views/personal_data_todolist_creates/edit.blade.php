@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Personal Data Todolist Create </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($personalDataTodolistCreate, ['route' => ['personalDataTodolistCreates.update', $personalDataTodolistCreate->id], 'method' => 'patch']) !!}

            @include('personal_data_todolist_creates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection