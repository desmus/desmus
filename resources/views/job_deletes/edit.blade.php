@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job Delete </h1>
    
  </section>
  
  <div class="content">
    
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          {!! Form::model($jobDelete, ['route' => ['jobDeletes.update', $jobDelete->id], 'method' => 'patch']) !!}

            @include('job_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection