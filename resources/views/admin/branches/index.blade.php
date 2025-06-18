@extends('admin.layout')
@section('title', 'Branch')


@section('content')
<div class="main-content">
    <div class="row small-spacing justify-content-center">
        <div class="col-10">
            <div class="box-content bordered-all" style="padding: 2% !important;">
                <h4 class="box-title"><i class="far fa-folder-open"></i> Data Branch</h4>
                <!-- /.box-title -->
                <div class="dropdown js__drop_down">
                    <a href="#" class="dropdown-icon fas fa-ellipsis-v js__drop_down_button"></a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('admin.branches.create') }}">Add Data</a></li>
                        <li> <a href="#">Report Data</a></li>
                    </ul>
                    <!-- /.sub-menu -->
                </div>
                <!-- /.dropdown js__dropdown -->

                <div class="table-responsive">
                    <table class="table table-striped dataTable">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th>Branch</th>
                                <th>Toko - PIC</th>
                                <th class="text-center">Users</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($branches as $index => $branch )
                            <tr>
                                <td class="text-center">{{ ($index+1) }}.</td>
                                <td>{{ ucwords($branch->name) }}</td>
                                <td>
                                    @foreach ($branch->stores as $no_index => $store)
                                    {{ ($no_index+1) }} . &nbsp; {{ $store->name }} - {{ $store->name_pic }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($branch->users as $no_index => $user)
                                    {{ ($no_index+1) }} . &nbsp; {{ $user->name }}<br>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.branches.edit', $branch->id) }}"
                                        class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                    <button type="button" class="btn btn-xs btn-danger btn-delete"
                                        onclick="confirm_delete(`{{ route('admin.branches.destroy', $branch->id) }}`)"><i class="fa fa-trash"></i></button>
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
