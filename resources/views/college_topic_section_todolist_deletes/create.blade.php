@extends('layouts.app')

@section('content')
    
  <section class="content-header">
    
    <h1> College Topic Section Todolist Delete </h1>
  
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'collegeTSTodolistDeletes.store']) !!}

            @include('college_topic_section_todolist_deletes.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection