@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Message View </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($messageView, ['route' => ['messageViews.update', $messageView->id], 'method' => 'patch']) !!}

            @include('message_views.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection