@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Contact Email Updates </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($contactEmailUpdates, ['route' => ['contactEmailUpdates.update', $contactEmailUpdates->id], 'method' => 'patch']) !!}

            @include('contact_email_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection