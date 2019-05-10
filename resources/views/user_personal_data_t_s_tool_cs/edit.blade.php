@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Personal Data T S Tool C </h1>
  
  </section>
   
  <div class="content">
      
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userPersonalDataTSToolC, ['route' => ['userPersonalDataTSToolCs.update', $userPersonalDataTSToolC->id], 'method' => 'patch']) !!}

            @include('user_personal_data_t_s_tool_cs.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
    
    </div>
  
  </div>

@endsection