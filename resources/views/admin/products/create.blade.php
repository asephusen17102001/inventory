@extends('admin.layout')
@section('title', 'Add Product')

@section('content')
<div class="main-content">
    <div class="row small-spacing justify-content-center">
        <div class="col-8">
            <div class="box-content bordered" style="padding: 3% !important;">
                <h4 class="box-title"><i class="fa fa-plus"></i> Form Add Product</h4>
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
                <form action="{{ route('admin.products.store') }}" method="post">
                    @csrf
                    <div class="row form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <div class="col-3 pt-2">
                            <label for="name">Nama Product <sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-9">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nama Product ..."
                                value="{{ old('name') }}" required>

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
                                <option value="active" {{ old('status') == "active" ? 'selected' : '' }}>Active</option>
                                <option value="non active" {{ old('status') == "non active" ? 'selected' : '' }}>Non
                                    Active
                                </option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="row form-group mt-5">
                        <div class="col-3 pt-2">
                            <label for="stock">Stock [ New ]</label>
                        </div>
                        <div class="col-4">
                            <input type="text" name="stock" class="format-rupiah form-control text-right" id="stock"
                                placeholder="Stock [ New ]..." value="{{ old('stock') ?? '0' }}" required>

                            @error('stock')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-3 pt-2">
                            <label for="stock_recondition">Stock [ Recondition ]</label>
                        </div>
                        <div class="col-4">
                            <input type="text" name="stock_recondition" class="format-rupiah form-control text-right"
                                id="stock_recondition" placeholder="Stock [ Recondition ] ..."
                                value="{{ old('stock_recondition') ?? '0' }}" required>

                            @error('stock_recondition')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="row form-group mt-5">
                        <div class="col-3 pt-2">
                            <label for="price">Harga [ New ]</label>
                        </div>
                        <div class="col-4">
                            <input type="text" name="price" class="format-rupiah form-control text-right" id="price"
                                placeholder="Harga [ New ]..." value="{{ old('price') ?? '0' }}" required>

                            @error('price')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-3 pt-2">
                            <label for="price_recondition">Harga [ Recondition ]</label>
                        </div>
                        <div class="col-4">
                            <input type="text" name="price_recondition" class="format-rupiah form-control text-right"
                                id="price_recondition" placeholder="Harga [ Recondition ] ..."
                                value="{{ old('price_recondition') ?? '0' }}" required>

                            @error('price_recondition')
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
