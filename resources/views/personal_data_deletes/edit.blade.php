@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Personal Data Delete </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($personalDataDelete, ['route' => ['personalDataDeletes.update', $personalDataDelete->id], 'method' => 'patch']) !!}

            @include('personal_data_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection