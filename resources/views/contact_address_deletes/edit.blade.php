@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Contact Address Deletes </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($contactAddressDeletes, ['route' => ['contactAddressDeletes.update', $contactAddressDeletes->id], 'method' => 'patch']) !!}

            @include('contact_address_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection