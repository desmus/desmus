@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Personal Data T S T F Todolist Update </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'personalDataTSTFTodolistUpdates.store']) !!}

            @include('personal_data_t_s_t_f_todolist_updates.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection