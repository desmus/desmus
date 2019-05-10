@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College T S Note Todolist Create </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTSNoteTodolistCreate, ['route' => ['collegeTSNoteTodolistCreates.update', $collegeTSNoteTodolistCreate->id], 'method' => 'patch']) !!}

            @include('college_t_s_note_todolist_creates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection