@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Contact Address Create </h1>
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($contactAddressCreate, ['route' => ['contactAddressCreates.update', $contactAddressCreate->id], 'method' => 'patch']) !!}

            @include('contact_address_creates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>
  
@endsection