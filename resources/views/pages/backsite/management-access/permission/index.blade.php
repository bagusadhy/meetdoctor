@extends('layouts.app')

@section('title', 'Permission')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">
            <header>
                <h3>Permission</h3>
                <p>Manage data for Permission</p>
            </header>

            <div class="table-responsive shadow p-3 mb-5 bg-body rounded">
                <table class="table">
                    <thead>
                        <tr class="">
                            <th>Tittle</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permission as $p)
                                <td>{{ $p->tittle }}</td>
                                <td>
                                    <div class="text-center">
                                        <a href="{{ route('config-payment.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <button onclick="event.preventDefault(); $('#form-delete').attr('action', '{{ route('config-payment.destroy', $p->id) }}'); document.getElementById('form-delete').submit()" class="btn btn-sm btn-danger">Delete
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

