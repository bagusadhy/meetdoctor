@extends('layouts.app')

@section('title', 'Role')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">

             @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    <ul>
                        @foreach ($errors->all() as $error )
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <header>
                <a href="{{ route('role.index') }}" style="text-decoration-color: #0d1458;">
                    <h3><span><i class="fa-solid fa-chevron-left"></i></span> Role</h3>
                </a>
                <p>Manage data for Role</p>
            </header>

            <div class="shadow p-3 mb-5 bg-body rounded">
                <form action="{{ route('role.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h4 class="mb-4">Update Role Data</h4>
                    <div class="mb-3">
                        <label for="title" class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', isset($role) ? $role->title : '') }}">
                    </div>
                    <div class="mb-3">
                        <label for="permission">
                            <span class="btn btn-warning btn-sm select-all">{{ 'Select All' }}</span>
                            <span class="btn btn-warning btn-sm deselect-all">{{ 'Deselect All' }}</span>
                        </label>
                        <select name="permission[]"
                                id="permission"
                                class="form-control select2"
                                multiple="multiple">
                           
                            @foreach ($permission as $id => $permission_item )
                                <option value="{{ $permission_item->id }}" {{ in_array($permission_item->id ,old('permission', [])) || isset($role) && $role->permission->contains($permission_item->id) ? 'selected' : '' }}>{{ $permission_item->title }}</option>
                            @endforeach
                                    
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
            
        </section>
    </main>
@endsection

@push('after-script')
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            $('.select-all').click(function() {
                let $select2 = $(this).parent().siblings('.select2')
                $select2.find('option').prop('selected', 'selected')
                $select2.trigger('change');
            });

            $('.deselect-all').click(function() {
                let $select2 = $(this).parent().siblings('.select2')
                $select2.find('option').prop('selected', '')
                $select2.trigger('change');
            });

        });
    </script>
@endpush

