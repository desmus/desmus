@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Contact View </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
          
          {!! Form::model($contactView, ['route' => ['contactViews.update', $contactView->id], 'method' => 'patch']) !!}

            @include('contact_views.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection