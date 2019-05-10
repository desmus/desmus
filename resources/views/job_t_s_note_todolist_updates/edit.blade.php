@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job T S Note Todolist Update </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($jobTSNoteTodolistUpdate, ['route' => ['jobTSNoteTodolistUpdates.update', $jobTSNoteTodolistUpdate->id], 'method' => 'patch']) !!}

            @include('job_t_s_note_todolist_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection