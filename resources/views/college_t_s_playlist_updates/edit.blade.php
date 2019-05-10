@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> College T S Playlist Update </h1>
  
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
          
          {!! Form::model($collegeTSPlaylistUpdate, ['route' => ['collegeTSPlaylistUpdates.update', $collegeTSPlaylistUpdate->id], 'method' => 'patch']) !!}

            @include('college_t_s_playlist_updates.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection