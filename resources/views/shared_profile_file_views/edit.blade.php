@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Shared Profile File View </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($sharedProfileFileView, ['route' => ['sharedProfileFileViews.update', $sharedProfileFileView->id], 'method' => 'patch']) !!}

            @include('shared_profile_file_views.fields')

          {!! Form::close() !!}
               
        </div>
          
      </div>
       
    </div>
  
  </div>

@endsection