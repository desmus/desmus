@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Public Note Comment Response </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'publicNoteCommentResponses.store']) !!}

            @include('public_note_comment_responses.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection