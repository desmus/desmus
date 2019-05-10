@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User College T S Galerie U </h1>
  
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'userCollegeTSGalerieUs.store']) !!}

            @include('user_college_t_s_galerie_us.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection