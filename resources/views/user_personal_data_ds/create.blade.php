@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Personal Data D </h1>
  
  </section>
    
  <div class="content">
        
    @include('adminlte-templates::common.errors')
        
    <div class="box box-primary">

      <div class="box-body">
                
        <div class="row">
                    
          {!! Form::open(['route' => 'userPersonalDataDs.store']) !!}

            @include('user_personal_data_ds.fields')

          {!! Form::close() !!}
                
        </div>
            
      </div>
        
    </div>
    
  </div>

@endsection