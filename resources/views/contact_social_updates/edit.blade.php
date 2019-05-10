@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Contact Social Updates </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($contactSocialUpdates, ['route' => ['contactSocialUpdates.update', $contactSocialUpdates->id], 'method' => 'patch']) !!}

            @include('contact_social_updates.fields')

          {!! Form::close() !!}
        
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection