@extends('adminlte::page')

@section('title', 'Import Events - Calendar App')

@section('content_header')

    <ol class="breadcrumb">
        <li>
        	<a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('event.index') }}">Events</a>
        </li>
        <li>
            Import Events
        </li>
    </ol>
@stop

@section('content')

    <div class="box-body">
        @include('includes.alerts')
    </div>

    <form role="form" method="POST" action="{{ route('event.importsave') }}" enctype="multipart/form-data">

    {!! csrf_field() !!}

    <div class="box-body">
        <div class="form-group col-md-4" id="div-title">
            <label>CSV:</label>
            <input id="csv_file" type="file" name="csv_file" required>
        </div>

        <div class="clearfix"></div>

        <div class="footer">
            <div class="col-md-6">
                <a href="{{ route('event.index') }}" class="btn btn-danger btn-voltar"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
            </div>
            <div class="col-md-6 text-right">
                <button type="submit" class="btn btn-success btn-salvar"><i class="fa fa-save" aria-hidden="true"></i> Import</button>
            </div>
            
        </div>
    </div>
    <!-- /.box-body -->

@stop