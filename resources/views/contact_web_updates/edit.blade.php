@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Contact Web Updates </h1>
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($contactWebUpdates, ['route' => ['contactWebUpdates.update', $contactWebUpdates->id], 'method' => 'patch']) !!}

            @include('contact_web_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection