@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Personal Data T S File U </h1>
  
  </section>
  
  <div class="content">
    
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userPersonalDataTSFileU, ['route' => ['userPersonalDataTSFileUs.update', $userPersonalDataTSFileU->id], 'method' => 'patch']) !!}

            @include('user_personal_data_t_s_file_us.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection