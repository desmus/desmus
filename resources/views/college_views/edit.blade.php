@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College View </h1>
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($collegeView, ['route' => ['collegeViews.update', $collegeView->id], 'method' => 'patch']) !!}

            @include('college_views.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection