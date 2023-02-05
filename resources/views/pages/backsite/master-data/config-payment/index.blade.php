@extends('layouts.app')

@section('title', 'Config Payment')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">
            <header>
                <h3>Config Payment</h3>
                <p>Manage data for Config Payment</p>
            </header>

            {{-- error --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @can('config_payment_table')
                <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
                    <table class="table" id="config-table">
                        <thead>
                            <tr class="bg-">
                                <th>Fee</th>
                                <th>Vat</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($config as $c)
                                <tr>
                                    <td>Rp.{{ number_format($c->fee) }}</td>
                                    <td>{{ number_format($c->vat) }}%</td>
                                    <td>
                                        <div class="text-center">
                                            <div class="btn-group">
                                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu">
                                                  
                                                    {{-- edit --}}
                                                    <li>
                                                        @can('config_payment_edit')
                                                        <a href="{{ route('config-payment.edit', $c->id) }}" class="dropdown-item">Edit</a>
                                                        @endcan
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <p>No Data</p>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endcan
        </section>
    </main>

@endsection

@push('after-script')
    <script>
        $(document).ready(function () {
            
            var table = $('#config-table').DataTable();

            // datatable
            // Setup - add a text input to each footer cell
            $('#config-table tfoot th').each( function (i) {
                var title = $('#config-table thead th').eq( $(this).index() ).text();
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

