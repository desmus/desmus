@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Job T S Playlist View </h1>
    
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'jobTSPlaylistViews.store']) !!}

            @include('job_t_s_playlist_views.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection