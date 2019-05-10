@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Contact Email Create </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($contactEmailCreate, ['route' => ['contactEmailCreates.update', $contactEmailCreate->id], 'method' => 'patch']) !!}

            @include('contact_email_creates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection