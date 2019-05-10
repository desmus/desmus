@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Shared Profile Note Like </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($sharedProfileNoteLike, ['route' => ['sharedProfileNoteLikes.update', $sharedProfileNoteLike->id], 'method' => 'patch']) !!}

            @include('shared_profile_note_likes.fields')

          {!! Form::close() !!}
               
        </div>
      
      </div>
       
    </div>
  
  </div>

@endsection