@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> U C T S Playlist Delete </h1>
  
  </section>
   
  <div class="content">
    
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($uCTSPlaylistDelete, ['route' => ['uCTSPlaylistDeletes.update', $uCTSPlaylistDelete->id], 'method' => 'patch']) !!}

            @include('u_c_t_s_playlist_deletes.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
  
  </div>

@endsection