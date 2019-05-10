@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Public Image Like </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($sharedProfileImageLike, ['route' => ['sharedProfileImageLikes.update', $sharedProfileImageLike->id], 'method' => 'patch']) !!}

            @include('shared_profile_image_likes.fields')

          {!! Form::close() !!}
               
        </div>
          
      </div>
    
    </div>
   
  </div>

@endsection