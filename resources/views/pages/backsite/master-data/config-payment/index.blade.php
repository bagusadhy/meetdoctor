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

            <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
                <table class="table">
                    <thead>
                        <tr class="bg-">
                            <th>Fee</th>
                            <th>Vat</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($config as $c)
                            <tr>
                                <td>Rp.{{ number_format($c->fee) }}</td>
                                <td>{{ $c->vat }}</td>
                                <td>
                                    <div class="text-center">
                                        <a href="{{ route('config-payment.edit', $c->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <button onclick="event.preventDefault(); $('#form-delete').attr('action', '{{ route('config-payment.destroy', $c->id) }}'); document.getElementById('form-delete').submit()" class="btn btn-sm btn-danger">Delete
                                            <form action="" id="form-delete" method="post" style="display: none">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>

@endsection

