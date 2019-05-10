@extends('layouts.app')

@section('content')
  
  <section class="content-header">
        
    <h1> Project Create </h1>
    
  </section>
  
  <div class="content">
    
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          {!! Form::model($projectCreate, ['route' => ['projectCreates.update', $projectCreate->id], 'method' => 'patch']) !!}
          
            @include('project_creates.fields')
            
          {!! Form::close() !!}
          
        </div>
        
      </div>
      
    </div>
    
  </div>

@endsection