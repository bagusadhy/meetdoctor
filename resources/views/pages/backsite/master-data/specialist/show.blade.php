@extends('layouts.app')

@section('title', 'Specialist')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">
            <header>
                <a href="{{ route('specialist.index') }}" style="text-decoration-color: #0d1458;">
                    <h3><span><i class="fa-solid fa-chevron-left"></i></span> Specialist</h3>
                </a>
                <p>Manage data for specialist</p>
            </header>

            <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
                <table class="table">
                    <thead>
                        <tr class="bg-">
                            <th>Name</th>
                            <th>Price</th>
                            <th>Created</th>
                            <th>Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $specialist->name }}</td>
                            <td>Rp.{{ number_format($specialist->price) }}</td>
                            <td>{{ $specialist->created_at }}</td>
                            <td>{{ $specialist->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </section>
    </main>
@endsection

