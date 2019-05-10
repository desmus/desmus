@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Job T S Galerie C </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userJobTSGalerieC, ['route' => ['userJobTSGalerieCs.update', $userJobTSGalerieC->id], 'method' => 'patch']) !!}

            @include('user_job_t_s_galerie_cs.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection