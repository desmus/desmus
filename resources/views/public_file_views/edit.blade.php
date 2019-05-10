@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Public File View </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($publicFileView, ['route' => ['publicFileViews.update', $publicFileView->id], 'method' => 'patch']) !!}

            @include('public_file_views.fields')

          {!! Form::close() !!}
               
        </div>
          
      </div>
       
    </div>
  
  </div>

@endsection