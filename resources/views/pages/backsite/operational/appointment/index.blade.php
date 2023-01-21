@extends('layouts.app')

@section('title', 'Appointment')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">
            <header>
                <h3>Appointment</h3>
                <p>Manage data for appointment</p>
            </header>
        </section>

        <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
                <table class="table" id="appointment-table">
                    <thead>
                        <tr class="">
                            <th>Doctor</th>
                            <th>Pasien</th>
                            <th>Consultation</th>
                            <th>Level</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($appointment as $key => $appointment_item)
                            <tr>
                                <td>{{ $appointment_item->doctor->name }}</td>
                                <td>{{ $appointment_item->user->name }}</td>
                                <td>{{ $appointment_item->consultation->name }}</td>
                                <td>
                                    @if($appointment_item->level == "1")
                                        <span class="badge rounded-pill text-bg-info">Low</span>
                                    @elseif($appointment_item->level == "2")
                                        <span class="badge rounded-pill text-bg-warning">Medium</span>
                                    @elseif($appointment_item->level == "3")
                                        <span class="badge rounded-pill text-bg-danger">High</span>
                                    @endif
                                </td>
                                <td>{{ $appointment_item->date ?? date('d-m-Y') }}</td>
                                <td>{{ $appointment_item->time ?? date('H:i:s') }}</td>
                                <td>
                                    @if($appointment_item->status == "1")
                                        <span class="badge rounded-pill text-bg-success">Payment Completed</span>
                                    @elseif($appointment_item->status == "2")
                                        <span class="badge rounded-pill text-bg-warning">Waiting Payment</span>
                                    @else
                                        <span>{{ 'N/A' }}</span>
                                        @endif
                                </td>
                            </tr>
                        @empty
                            {{--  --}}
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
        </div>
        </section>
    </main>
@endsection

@push('after-script')

    <script>
        $(document).ready(function(){
            var table = $('#appointment-table').DataTable();

            // datatable
            // Setup - add a text input to each footer cell
            $('#appointment-table tfoot th').each( function (i) {
                var title = $('#appointment-table thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" class="form-control" placeholder="Search '+ title +'" data-index="'+i+'" style="width:100%;"/>' );
            } );


            // Filter event handler
            $( table.table().container() ).on( 'keyup', 'tfoot input', function () {
                table
                    .column( $(this).data('index') )
                    .search( this.value )
                    .draw();
            } );
        });
    </script>
@endpush
