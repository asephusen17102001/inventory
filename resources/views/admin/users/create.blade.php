@extends('admin.layout')
@section('title', 'Add User')



@push('css-custome')
<style>

    .select2-selection__rendered {
        line-height: 45px !important;
    }

    .select2-container .select2-selection--single {
        height: 45px !important;
    }

    .select2-selection__arrow {
        height: 45px !important;
    }

</style>
@endpush

@section('content')
<div class="main-content">
    <div class="row small-spacing justify-content-center">
        <div class="col-6">
            <div class="box-content bordered" style="padding: 3% !important;">
                <h4 class="box-title"><i class="fa fa-plus"></i> Form Add User</h4>
                <!-- /.box-title -->
                <div class="dropdown js__drop_down">
                    <a href="#" class="dropdown-icon fas fa-ellipsis-v js__drop_down_button"></a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('admin.users.index') }}">Kembali</a></li>
                    </ul>
                    <!-- /.sub-menu -->
                </div>
                <!-- /.dropdown js__dropdown -->

                <hr>
                <form action="{{ route('admin.users.store') }}" method="post">
                    @csrf

                    <div class="row form-group mb-5">
                        <div class="col-3 pt-2">
                            <label for="name">Branch <sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-9">
                            <select name="branch_id" id="branch_id" class="form-control select2" required>
                                <option value=""></option>
                                @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                            @error('branch_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="row form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <div class="col-3 pt-2">
                            <label for="name">Nama User <sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nama User ..."
                                value="{{ old('name') }}" required>

                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <div class="col-3 pt-2">
                            <label for="email">Email <sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-9">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email ..."
                                value="{{ old('email') }}" required>

                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="row form-group" style="display: none;">
                        <div class="col-3 pt-2">
                            <label for="name">Role Akses <sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-9">
                            <select name="role" id="role" class="form-control select2" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="branch" selected>Branch</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('role')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <br><br>

                    <div class="row form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <div class="col-3 pt-2">
                            <label for="password">Password <sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-9">
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Password ..." required>

                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>



                    <div class="row form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                        <div class="col-3 pt-2">
                            <label for="password_confirmation">Confirm Password <sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-9">
                            <input type="password" name="password_confirmation" class="form-control"
                                id="password_confirmation" placeholder="Confirm Password ..." required>

                            @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="float-right mt-5">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-xs btn-dark">Cancel</a>
                        <button type="submit" class="btn btn-xs btn-primary">Save Data</button>
                    </div>
                </form>
            </div>
            <!-- /.box-content -->
        </div>
        <!-- /.col -->
    </div>
</div>
@endsection


@push('js-custome')
<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "-- Pilih Branch --",
        });
    });

</script>
@endpush
