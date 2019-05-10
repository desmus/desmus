@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Personal Data U </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
      
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userPersonalDataU, ['route' => ['userPersonalDataUs.update', $userPersonalDataU->id], 'method' => 'patch']) !!}

            @include('user_personal_data_us.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection