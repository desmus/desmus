@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Public Image Comment </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($sharedProfileImageComment, ['route' => ['sharedProfileImageComments.update', $sharedProfileImageComment->id], 'method' => 'patch']) !!}

            @include('shared_profile_image_comments.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection