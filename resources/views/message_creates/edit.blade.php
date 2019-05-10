@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Message Create </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
      
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($messageCreate, ['route' => ['messageCreates.update', $messageCreate->id], 'method' => 'patch']) !!}

            @include('message_creates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection