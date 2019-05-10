@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Contact Social Create </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($contactSocialCreate, ['route' => ['contactSocialCreates.update', $contactSocialCreate->id], 'method' => 'patch']) !!}

            @include('contact_social_creates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection