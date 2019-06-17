@extends('adminlte::page')

@section('title', 'Events - Calendar App')

@section('content_header')
    <h1>Events</h1>

    <ol class="breadcrumb">
        <li>
        	<a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li>
        	Events
        </li>
    </ol>
@stop

@section('content')
    <div class="box-body">
        @include('includes.alerts')
    </div>

    <div class="div-btn" style="margin-bottom: 25px;margin-top: 55px">
        <a href="{{ route('event.create') }}" class="btn btn-success"><i class="fa fa-fw fa-calendar-plus-o"></i> New Event</a>
    </div>

    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="list-events" class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr role="row">
                                    <th width="15%">Created</th>
                                    <th width="15%">Title</th>
                                    <th width="20%">Start</th>
                                    <th width="20%">End</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($events as $event)
                                    <tr>
                                        <td>{{ $event->created_at }}</td>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->start_datetime }}</td>
                                        <td>{{ $event->end_datetime }}</td>
                                        <td class="justif">
                                            <a href="{{ route('event.edit', $event->id) }}" class="btn btn-primary">
                                                <i class="fa fa-fw fa-pencil"></i>
                                            </a>
                                            <a href="{{ route('event.show', $event->id) }}" class="btn btn-primary">
                                                <i class="fa fa-fw fa-eye"></i>
                                            </a>
                                            <a href="{{ route('event.delete', $event->id) }}" class="btn btn-danger">
                                                <i class="fa fa-fw fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <script>
        $(function () {
            $('#list-events').DataTable({
                columns: [
                    null,
                    null,
                    null,
                    null,
                    { "orderable": false },
                ],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]                
            });
        });
    </script>
@stop