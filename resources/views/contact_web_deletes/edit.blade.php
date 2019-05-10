@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Contact Web Deletes </h1>
  
  </section>
   
  <div class="content">
      
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($contactWebDeletes, ['route' => ['contactWebDeletes.update', $contactWebDeletes->id], 'method' => 'patch']) !!}

            @include('contact_web_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection