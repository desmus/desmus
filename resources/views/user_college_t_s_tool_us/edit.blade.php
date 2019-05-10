@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User College T S Tool U </h1>
   
  </section>
   
  <div class="content">
      
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userCollegeTSToolU, ['route' => ['userCollegeTSToolUs.update', $userCollegeTSToolU->id], 'method' => 'patch']) !!}

            @include('user_college_t_s_tool_us.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
       
    </div>
   
  </div>

@endsection