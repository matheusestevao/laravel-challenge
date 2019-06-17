@extends('adminlte::page')

@section('title', 'Events - Calendar App')

@section('content_header')
    <h1>Add Event</h1>

    <ol class="breadcrumb">
        <li>
        	<a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('event.index') }}">Events</a>
        </li>
        <li>
        	Add Event
        </li>
    </ol>
@stop

@section('content')


@stop