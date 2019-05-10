@extends('layouts.app')

@section('content')
  
  <section class="content-header">
        
    <h1> Personal Data Topic Todolist Update </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'personalDataTopicTodolistUpdates.store']) !!}

            @include('personal_data_topic_todolist_updates.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection