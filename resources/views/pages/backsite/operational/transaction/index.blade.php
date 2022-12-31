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
                    <table class="table">
                        <thead>
                            <tr class="">
                                <th>Appointment</th>
                                <th>Fee Doctor</th>
                                <th>Fee Specialist</th>
                                <th>Fee Hospital</th>
                                <th>Sub Total</th>
                                <th>Vat</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $t)
                                <tr>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </section>
    </main>
@endsection
