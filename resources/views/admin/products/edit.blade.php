@extends('admin.layout')
@section('title', 'Edit Product')

@section('content')
<div class="main-content">
    <div class="row small-spacing justify-content-center">
        <div class="col-6">
            <div class="box-content bordered" style="padding: 3% !important;">
                <h4 class="box-title"><i class="fa fa-edit"></i> Form Edit Product</h4>
                <!-- /.box-title -->
                <div class="dropdown js__drop_down">
                    <a href="#" class="dropdown-icon fas fa-ellipsis-v js__drop_down_button"></a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('admin.products.index') }}">Kembali</a></li>
                    </ul>
                    <!-- /.sub-menu -->
                </div>
                <!-- /.dropdown js__dropdown -->

                <hr>
                <form action="{{ route('admin.products.update', $product->id) }}" method="post">
                    @method('PUT')
                    @csrf

                    <div class="row form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <div class="col-3 pt-2">
                            <label for="name">Nama Product <sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nama Product ..."
                                value="{{ old('name') ?? $product->name }}" required>

                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-3 pt-2">
                            <label for="name">Status Product <sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-9">
                            <select name="status" id="status" class="form-control" required>
                                <option value="active" {{ $product->status == "active" ? 'selected' : '' }}>Active
                                </option>
                                <option value="non active" {{ $product->status == "non active" ? 'selected' : '' }}>Non
                                    Active
                                </option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-3 pt-2">
                            <label for="stock">Stock Product <sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-9">
                            <input type="number" name="stock" class="form-control" id="stock"
                                placeholder="Stock Product ..." value="{{ old('stock') ?? $product->stock }}" required>

                            @error('stock')
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
