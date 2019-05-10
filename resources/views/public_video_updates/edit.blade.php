@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Public Video Update </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($publicVideoUpdate, ['route' => ['publicVideoUpdates.update', $publicVideoUpdate->id], 'method' => 'patch']) !!}

            @include('public_video_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection