@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Personal Data C </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userPersonalDataC, ['route' => ['userPersonalDataCs.update', $userPersonalDataC->id], 'method' => 'patch']) !!}

            @include('user_personal_data_cs.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>
  
@endsection