@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College T S Tool Create </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeTSToolCreate, ['route' => ['collegeTSToolCreates.update', $collegeTSToolCreate->id], 'method' => 'patch']) !!}

            @include('college_t_s_tool_creates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection