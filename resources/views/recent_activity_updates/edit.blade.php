@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Recent Activity Update </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                  
          {!! Form::model($recentActivityUpdate, ['route' => ['recentActivityUpdates.update', $recentActivityUpdate->id], 'method' => 'patch']) !!}
  
            @include('recent_activity_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection