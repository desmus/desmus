@extends('layouts.app')

@section('content')
    
  <section class="content-header">
    
    <h1> College T S Galery Create </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'collegeTSGaleryCreates.store']) !!}

            @include('college_t_s_galery_creates.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
  
  </div>

@endsection