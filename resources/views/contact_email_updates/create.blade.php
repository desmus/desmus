@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> Contact Email Updates </h1>
  
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'contactEmailUpdates.store']) !!}

            @include('contact_email_updates.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>
  
@endsection