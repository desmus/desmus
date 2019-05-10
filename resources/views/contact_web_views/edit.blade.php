@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Contact Web View </h1>
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($contactWebView, ['route' => ['contactWebViews.update', $contactWebView->id], 'method' => 'patch']) !!}

            @include('contact_web_views.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection