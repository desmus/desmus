@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Project Update </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($projectUpdate, ['route' => ['projectUpdates.update', $projectUpdate->id], 'method' => 'patch']) !!}

            @include('project_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection