@extends('layouts.app')

@section('title', 'Consultation')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">
            <header>
                <a href="{{ route('consultation.index') }}" style="text-decoration-color: #0d1458;">
                    <h3><span><i class="fa-solid fa-chevron-left"></i></span> Consultation</h3>
                </a>
                <p>Manage data for Consultation</p>
            </header>

            <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
                <table class="table">
                    <thead>
                        <tr class="bg-">
                            <th>Name</th>
                            <th>Created</th>
                            <th>Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $consultation->name }}</td>
                            <td>{{ $consultation->created_at }}</td>
                            <td>{{ $consultation->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </section>
    </main>
@endsection

