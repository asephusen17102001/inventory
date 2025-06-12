@extends('admin.layout')
@section('title', 'Edit Toko')

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
                <h4 class="box-title"><i class="fa fa-plus"></i> Form Edit Toko</h4>
                <!-- /.box-title -->
                <div class="dropdown js__drop_down">
                    <a href="#" class="dropdown-icon fas fa-ellipsis-v js__drop_down_button"></a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('admin.stores.index') }}">Kembali</a></li>
                    </ul>
                    <!-- /.sub-menu -->
                </div>
                <!-- /.dropdown js__dropdown -->

                <hr>
                <form action="{{ route('admin.stores.update', $store->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row form-group">
                        <div class="col-3 pt-2">
                            <label for="name">Branch <sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-9">
                            <select name="branch_id" id="branch_id" class="form-control select2" required>
                                <option value=""></option>
                                @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}"
                                    {{ $store->branch_id == $branch->id ? "selected" : ""}}>{{ $branch->name }}</option>
                                @endforeach
                            </select>
                            @error('branch_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <div class="col-3 pt-2">
                            <label for="name">Nama Toko <sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nama Toko ..."
                                value="{{ old('name') ?? $store->name}}" required>

                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-3 pt-2">
                            <label for="name">Status Toko <sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-9">
                            <select name="status" id="status" class="form-control" required>
                                <option value="active" {{  $store->status == "active" ? 'selected' : '' }}>Active
                                </option>
                                <option value="non active" {{  $store->status == "non active" ? 'selected' : '' }}>Non
                                    Active
                                </option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                        <div class="col-3 pt-2">
                            <label for="address">Alamat</label>
                        </div>
                        <div class="col-9">
                            <textarea name="address" id="address" class="form-control">{{ $store->address }}</textarea>

                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <br><br><br>

                    <div class="row form-group {{ $errors->has('ppic') ? 'has-error' : '' }}">
                        <div class="col-3 pt-2">
                            <label for="ppic">Nama PIC</label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="ppic" class="form-control" id="ppic" placeholder="Nama PIC ..."
                                value="{{ old('ppic') ?? $store->ppic }}" required>

                            @error('ppic')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group {{ $errors->has('contact') ? 'has-error' : '' }}">
                        <div class="col-3 pt-2">
                            <label for="contact">Kontak Hub.</label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="contact" class="form-control" id="contact"
                                placeholder="Kontak Hub..." value="{{ old('contact') ?? $store->contact }}" required>

                            @error('contact')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="float-right mt-5">
                        <a href="{{ route('admin.stores.index') }}" class="btn btn-xs btn-dark">Cancel</a>
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
