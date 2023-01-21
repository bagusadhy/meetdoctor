@extends('layouts.app')

@section('title', 'Transaction')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">
            <header>
                <h3>Transaction</h3>
                <p>Manage data for Transaction</p>
            </header>
            <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
                <table class="table" id="transaction-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Doctor</th>
                            <th>Patient</th>
                            <th>Fee Doctor</th>
                            <th>Fee Specialist</th>
                            <th>Fee Hospital</th>
                            <th>Sub total</th>
                            <th>Vat</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaction as $key => $transaction_item)
                            <tr data-entry-id="{{ $transaction_item->id }}">
                                <td>{{ isset($transaction_item->created_at) ? date("d/m/Y H:i:s",strtotime($transaction_item->created_at)) : '' }}</td>
                                <td>{{ $transaction_item->appointment->doctor->name ?? '' }}</td>
                                <td>{{ $transaction_item->appointment->user->name ?? '' }}</td>
                                <td>{{ 'IDR '.number_format($transaction_item->fee_doctor) ?? '' }}</td>
                                <td>{{ 'IDR '.number_format($transaction_item->fee_specialist) ?? '' }}</td>
                                <td>{{ 'IDR '.number_format($transaction_item->fee_hospital) ?? '' }}</td>
                                <td>{{ 'IDR '.number_format($transaction_item->sub_total) ?? '' }}</td>
                                <td>{{ 'IDR '.number_format($transaction_item->vat) ?? '' }}</td>
                                <td>{{ 'IDR '.number_format($transaction_item->total) ?? '' }}</td>
                            </tr>
                        @empty
                            {{-- not found --}}
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
            var table = $('#transaction-table').DataTable();

            // datatable
            // Setup - add a text input to each footer cell
            $('#transaction-table tfoot th').each( function (i) {
                var title = $('#transaction-table thead th').eq( $(this).index() ).text();
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
