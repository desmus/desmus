@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Contact Telephone View </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($contactTelephoneView, ['route' => ['contactTelephoneViews.update', $contactTelephoneView->id], 'method' => 'patch']) !!}

            @include('contact_telephone_views.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection