@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Personal Data Todolist Delete </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'personalDataTodolistDeletes.store']) !!}

            @include('personal_data_todolist_deletes.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
@endsection