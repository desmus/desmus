@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Recent Activity Delete </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($recentActivityDelete, ['route' => ['recentActivityDeletes.update', $recentActivityDelete->id], 'method' => 'patch']) !!}

            @include('recent_activity_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection