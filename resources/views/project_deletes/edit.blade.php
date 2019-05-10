@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Project Delete </h1>
    
  </section>
  
  <div class="content">
    
    @include('adminlte-templates::common.errors')
    
    <div class="box box-primary">
      
      <div class="box-body">
        
        <div class="row">
          
          {!! Form::model($projectDelete, ['route' => ['projectDeletes.update', $projectDelete->id], 'method' => 'patch']) !!}

            @include('project_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection