@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Job C </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userJobC, ['route' => ['userJobCs.update', $userJobC->id], 'method' => 'patch']) !!}

            @include('user_job_cs.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection