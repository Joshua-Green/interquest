@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Territory
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($territories, ['route' => ['territories.update', $territories->id], 'method' => 'patch']) !!}

                        @include('territories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection