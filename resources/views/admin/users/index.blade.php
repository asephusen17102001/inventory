@extends('admin.layout')
@section('title', 'User')
@push('css-custome')

<style>
    tr>td {
        font-size: 12px !important;
        font-weight: 600 !important;
        vertical-align: middle !important;
    }

</style>
@endpush

@section('content')
<div class="main-content">
    <div class="row small-spacing justify-content-center">
        <div class="col-10">
            <div class="box-content bordered" style="padding: 2% !important;">
                <h4 class="box-title"><i class="far fa-folder-open"></i> Data User</h4>
                <!-- /.box-title -->
                <div class="dropdown js__drop_down">
                    <a href="#" class="dropdown-icon fas fa-ellipsis-v js__drop_down_button"></a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('admin.users.create') }}">Add Data</a></li>
                        {{-- <li> <a href="#">Report Data</a></li> --}}
                    </ul>
                    <!-- /.sub-menu -->
                </div>
                <!-- /.dropdown js__dropdown -->

                <div class="table-responsive">
                    <table class="table table-striped dataTable">
                        <thead class="table-secondary text-black">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Role Akses</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user )
                            <tr>
                                <td class="text-center">{{ ($index+1) }}.</td>
                                <td>{{ ucwords($user->name) }}</td>
                                <td>{{ $user->email }}</td>
                                <td><span class="badge badge-info">{{ $user->role }}</span></td>
                                <td class="text-center">
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                    <button type="button" class="btn btn-xs btn-danger btn-delete"
                                        onclick="confirm_delete(`{{ route('admin.users.destroy', $user->id) }}`)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /.box-content -->
        </div>
        <!-- /.col -->
    </div>
</div>
@endsection


@push('js-custome')
<script>
    $(document).ready(function () {
        $('.dataTable').dataTable();

        @session('success')
        alert_success("{{ session('success') }}");
        @endsession

        @session('failed')
        alert_success("{{ session('failed') }}");
        @endsession
    })

</script>
@endpush
