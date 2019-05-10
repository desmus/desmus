@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> General Search </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($generalSearch, ['route' => ['generalSearches.update', $generalSearch->id], 'method' => 'patch']) !!}

            @include('general_searches.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
      
    </div>
   
  </div>

@endsection