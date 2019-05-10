@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Personal Data T S Note Todolist View </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'personalDataTSNoteTodolistViews.store']) !!}

            @include('personal_data_t_s_note_todolist_views.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection