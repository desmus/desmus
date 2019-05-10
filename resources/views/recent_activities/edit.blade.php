@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Recent Activity </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($recentActivity, ['route' => ['recentActivities.update', $recentActivity->id], 'method' => 'patch']) !!}

            @include('recent_activities.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection