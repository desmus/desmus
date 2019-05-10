@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Personal Data T S File Create </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($personalDataTSFileCreate, ['route' => ['personalDataTSFileCreates.update', $personalDataTSFileCreate->id], 'method' => 'patch']) !!}

            @include('personal_data_t_s_file_creates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
    
    </div>
  
  </div>

@endsection