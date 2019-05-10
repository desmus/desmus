@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User Shared Profile Update
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userSharedProfileUpdate, ['route' => ['userSharedProfileUpdates.update', $userSharedProfileUpdate->id], 'method' => 'patch']) !!}

                        @include('user_shared_profile_updates.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection