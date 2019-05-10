@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College T S P T Create </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTSPTCreate, ['route' => ['collegeTSPTCreates.update', $collegeTSPTCreate->id], 'method' => 'patch']) !!}

            @include('college_t_s_p_t_creates.fields')

          {!! Form::close() !!}
               
        </div>
          
      </div>
       
    </div>
  
  </div>

@endsection