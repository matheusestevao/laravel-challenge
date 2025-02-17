@extends('adminlte::page')

@section('title', 'Events - Calendar App')

@section('content_header')
    
    @if (!isset($event))
        <h1>Add Event</h1>
    @else
        <h1>Edit Event</h1>
    @endif

    <ol class="breadcrumb">
        <li>
        	<a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('event.index') }}">Events</a>
        </li>
        <li>
            @if (!isset($event))
                Add Event
            @else
                Edit Event
            @endif
        </li>
    </ol>
@stop

@section('content')
    <div class="box-body">
        @include('includes.alerts')
    </div>

    @if (!isset($event))
		<form role="form" method="POST" action="{{ route('event.store') }}">
	@else
		<form role="form" method="POST" action="{{ route('event.update', $event->id) }}">
	@endif

    {!! csrf_field() !!}

    <div class="box-body">
        <div class="form-group col-md-4" id="div-title">
            <label>Title:</label>
            <input name="title" id="title" type="text" class="title form-control" placeholder="Title" value="{{ $event->title or old('title') }}">
        </div>

        <div class="form-group col-md-8" id="div-start_end_datetime">
            <label>Date and Time for Start and End of the Event:</label>
            <input name="start_end_datetime" id="start_end_datetime" type="text" class="start_end_datetime form-control" placeholder="Date and Time for Start and End of the Event" value="{{ $dateTime or old('start_end_datetime') }}">
        </div>

        <div class="form-group col-md-12" id="div-description">
            <label>Description:</label>
            <textarea name="description" id="description" rows="10" class="description form-control" placeholder="Describe here about your event">{{ $event->description or old('description') }}</textarea>
        </div>

        <div class="clearfix"></div>

        <div class="footer">
            <div class="col-md-6">
                <a href="{{ route('event.index') }}" class="btn btn-danger btn-voltar"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
            </div>
            @if(!isset($event))
                <div class="col-md-6 text-right">
                    <button type="submit" class="btn btn-success btn-salvar"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                </div>
            @else
                <div class="col-md-6 text-right">
                    <button type="submit" class="btn btn-success btn-salvar"><i class="fa fa-save" aria-hidden="true"></i> Update</button>
                </div>
            @endif
            
        </div>
    </div>
    <!-- /.box-body -->

    <script>
        $(function() {
            //Date range picker with time picker
            $('#start_end_datetime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: 
                    {
                        format: 'MM/DD/YYYY hh:mm A'
                    }
            })
        });
    </script>
@stop