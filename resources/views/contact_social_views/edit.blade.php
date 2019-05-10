@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Contact Social View </h1>
  
  </section>
  
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($contactSocialView, ['route' => ['contactSocialViews.update', $contactSocialView->id], 'method' => 'patch']) !!}

            @include('contact_social_views.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection