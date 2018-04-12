@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Fiefdoms
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($fiefdoms, ['route' => ['fiefdoms.update', $fiefdoms->id], 'method' => 'patch']) !!}

                        @include('fiefdoms.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection