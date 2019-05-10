@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Personal Data Create </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($personalDataCreate, ['route' => ['personalDataCreates.update', $personalDataCreate->id], 'method' => 'patch']) !!}

            @include('personal_data_creates.fields')

          {!! Form::close() !!}
               
        </div>
          
      </div>
       
    </div>
  
  </div>

@endsection