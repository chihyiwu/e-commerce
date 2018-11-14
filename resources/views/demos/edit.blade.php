@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Demo
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($demo, ['route' => ['demos.update', $demo->id], 'method' => 'patch']) !!}

                        @include('demos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection