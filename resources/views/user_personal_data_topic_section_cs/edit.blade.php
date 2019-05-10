@extends('layouts.app')

@section('content')
    
  <section class="content-header">
        
    <h1> User Personal Data Topic Section C </h1>
   
  </section>
   
  <div class="content">
       
    @include('adminlte-templates::common.errors')
       
    <div class="box box-primary">
           
      <div class="box-body">
               
        <div class="row">
                   
          {!! Form::model($userPersonalDataTopicSectionC, ['route' => ['userPersonalDataTopicSectionCs.update', $userPersonalDataTopicSectionC->id], 'method' => 'patch']) !!}

            @include('user_personal_data_topic_section_cs.fields')

          {!! Form::close() !!}
               
        </div>
           
      </div>
    
    </div>
   
  </div>

@endsection