@extends('layouts.app')

@section('content')
  
  <section class="content-header">
        
    <h1> Personal Data Todolist Update </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($personalDataTodolistUpdate, ['route' => ['personalDataTodolistUpdates.update', $personalDataTodolistUpdate->id], 'method' => 'patch']) !!}

            @include('personal_data_todolist_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection