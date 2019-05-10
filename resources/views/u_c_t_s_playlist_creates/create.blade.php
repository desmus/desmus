@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> U C T S Playlist Create </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'uCTSPlaylistCreates.store']) !!}

            @include('u_c_t_s_playlist_creates.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection