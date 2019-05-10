@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Public Image Update </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($publicImageUpdate, ['route' => ['publicImageUpdates.update', $publicImageUpdate->id], 'method' => 'patch']) !!}

            @include('public_image_updates.fields')

          {!! Form::close() !!}
        
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection