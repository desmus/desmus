@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Public Video Comment </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($publicVideoComment, ['route' => ['publicVideoComments.update', $publicVideoComment->id], 'method' => 'patch']) !!}

            @include('public_video_comments.fields')

          {!! Form::close() !!}
               
        </div>
          
      </div>
       
    </div>
  
  </div>

@endsection