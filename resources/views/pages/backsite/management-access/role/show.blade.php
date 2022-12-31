@extends('layouts.app')

@section('title', 'Role')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">
            <header>
                <a href="{{ route('role.index') }}" style="text-decoration-color: #0d1458;">
                    <h3><span><i class="fa-solid fa-chevron-left"></i></span> Role</h3>
                </a>
                <p>Manage data for Role</p>
            </header>

            <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
                <table class="table">
                    <thead>
                        <tr class="bg-">
                            <th>Title</th>
                            <th>Created</th>
                            <th>Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $role->title }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>{{ $role->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </section>
    </main>
@endsection

