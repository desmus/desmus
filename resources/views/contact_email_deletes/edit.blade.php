@extends('layouts.app')

@section('content')

  <section class="content-header">
        
    <h1> Contact Email Deletes </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($contactEmailDeletes, ['route' => ['contactEmailDeletes.update', $contactEmailDeletes->id], 'method' => 'patch']) !!}

            @include('contact_email_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection