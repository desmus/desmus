@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Personal Data T S P T Create </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'personalDataTSPTCreates.store']) !!}

            @include('personal_data_t_s_p_t_creates.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection