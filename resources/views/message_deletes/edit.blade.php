@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Message Delete </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($messageDelete, ['route' => ['messageDeletes.update', $messageDelete->id], 'method' => 'patch']) !!}

            @include('message_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection