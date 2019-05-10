@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Public Note Comment </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($publicNoteComment, ['route' => ['publicNoteComments.update', $publicNoteComment->id], 'method' => 'patch']) !!}

            @include('public_note_comments.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection