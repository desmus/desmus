@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Contact Telephone Deletes </h1>
  
  </section>
   
  <div class="content">
    
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($contactTelephoneDeletes, ['route' => ['contactTelephoneDeletes.update', $contactTelephoneDeletes->id], 'method' => 'patch']) !!}

            @include('contact_telephone_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection