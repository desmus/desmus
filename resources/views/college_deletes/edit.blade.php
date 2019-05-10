@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College Delete </h1>
    
  </section>
  
  <div class="content">
    
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          {!! Form::model($collegeDelete, ['route' => ['collegeDeletes.update', $collegeDelete->id], 'method' => 'patch']) !!}

            @include('college_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection