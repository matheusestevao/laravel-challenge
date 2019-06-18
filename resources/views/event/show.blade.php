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
            <label>Title:</label><br />
            <span>{{ $event->title }}</span>
        </div>

        <div class="form-group col-md-8" id="div-start_end_datetime">
            <label>Date and Time for Start and End of the Event:</label><br />
            <span>{{ dateDBSys($event->start_datetime) }} {{ dateDBSys($event->end_datetime) }}</span>
        </div>

        <div class="form-group col-md-12" id="div-description">
            <label>Description:</label><br />
            <span>{{ nl2br($event->description) }}</span>
        </div>

        <div class="clearfix"></div>

        <div class="footer">
            <div class="col-md-6">
                <a href="{{ route('event.index') }}" class="btn btn-danger btn-voltar"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('event.edit', $event->id) }}" class="btn btn-warning btn-edit"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
            </div>
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