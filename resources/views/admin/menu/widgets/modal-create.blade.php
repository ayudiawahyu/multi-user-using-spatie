<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="createMenu" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createMenu">Tambah Menu Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="mb-2">Foto<span class="text-danger">*</span></label>
                                <img id="image-preview" src="#" alt="Preview Gambar"
                                    style="display:none; margin-top:10px; max-width:30%;" class="mb-3">
                                <input type="file" class="form-control mb-3" name="image" id="image"
                                    value="{{ old('image') }}" accept="image/png, image/jpeg, image/jpg"
                                    onchange="previewImage(event)">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label>Nama Menu <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name') }}" placeholder="Masukkan nama menu">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label>Harga <span class="text-danger">*</span></label>
                                <input type="number" name="price" class="form-control"
                                    value="{{ old('price') }}" placeholder="Masukkan harga menu">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="mb-2">Status<span class="text-danger">*</span></label>
                                <select name="status" class="form-control" id="status-input">
                                    <option value="tersedia" selected>Tersedia</option>
                                    <option value="kosong">Kosong</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-3" style="position: relative;">
                                <label>Deskripsi <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Masukkan deskripsi menu">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-danger"
                        data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-rounded btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>