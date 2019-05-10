@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User Shared Profile Delete
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'userSharedProfileDeletes.store']) !!}

                        @include('user_shared_profile_deletes.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
