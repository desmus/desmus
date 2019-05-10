@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Personal Data View </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($personalDataView, ['route' => ['personalDataViews.update', $personalDataView->id], 'method' => 'patch']) !!}

            @include('personal_data_views.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection