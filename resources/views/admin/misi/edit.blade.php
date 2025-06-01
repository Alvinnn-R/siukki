@extends('layouts.admin')

@section('title', 'Edit Misi')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Misi</h3>
                    </div>
                    <form action="{{ route('admin.misi.update', $misi) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_misi">Nama Misi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nama_misi') is-invalid @enderror"
                                            id="nama_misi" name="nama_misi" value="{{ old('nama_misi', $misi->nama_misi) }}"
                                            required>
                                        @error('nama_misi')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipe_misi">Tipe Misi <span class="text-danger">*</span></label>
                                        <select class="form-control @error('tipe_misi') is-invalid @enderror" id="tipe_misi"
                                            name="tipe_misi" required>
                                            <option value="">Pilih Tipe Misi</option>
                                            <option value="harian"
                                                {{ old('tipe_misi', $misi->tipe_misi) == 'harian' ? 'selected' : '' }}>
                                                Harian</option>
                                            <option value="mingguan"
                                                {{ old('tipe_misi', $misi->tipe_misi) == 'mingguan' ? 'selected' : '' }}>
                                                Mingguan</option>
                                            <option value="event"
                                                {{ old('tipe_misi', $misi->tipe_misi) == 'event' ? 'selected' : '' }}>Event
                                            </option>
                                        </select>
                                        @error('tipe_misi')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $misi->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="xp_reward">XP Reward <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('xp_reward') is-invalid @enderror"
                                            id="xp_reward" name="xp_reward" value="{{ old('xp_reward', $misi->xp_reward) }}"
                                            min="0" required>
                                        @error('xp_reward')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select class="form-control @error('status') is-invalid @enderror" id="status"
                                            name="status" required>
                                            <option value="aktif"
                                                {{ old('status', $misi->status) == 'aktif' ? 'selected' : '' }}>Aktif
                                            </option>
                                            <option value="nonaktif"
                                                {{ old('status', $misi->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="jadwal">Jadwal <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('jadwal') is-invalid @enderror"
                                            id="jadwal" name="jadwal"
                                            value="{{ old('jadwal', $misi->jadwal->format('Y-m-d')) }}" required>
                                        @error('jadwal')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_mulai">Tanggal Mulai <span class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                            id="tanggal_mulai" name="tanggal_mulai"
                                            value="{{ old('tanggal_mulai', $misi->tanggal_mulai->format('Y-m-d')) }}"
                                            required>
                                        @error('tanggal_mulai')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_selesai">Tanggal Selesai <span
                                                class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                            id="tanggal_selesai" name="tanggal_selesai"
                                            value="{{ old('tanggal_selesai', $misi->tanggal_selesai->format('Y-m-d')) }}"
                                            required>
                                        @error('tanggal_selesai')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="icon">Icon Misi</label>
                                @if ($misi->icon)
                                    <div class="mb-2">
                                        <img src="{{ $misi->icon_url }}" alt="Current Icon" class="img-thumbnail"
                                            style="max-width: 100px;">
                                        <p class="text-muted mt-1">Icon saat ini</p>
                                    </div>
                                @endif
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('icon') is-invalid @enderror"
                                        id="icon" name="icon" accept="image/svg+xml">
                                    <label class="custom-file-label" for="icon">Pilih file SVG baru (opsional)</label>
                                </div>
                                @error('icon')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                                <small class="text-muted">Format: SVG only. File akan disimpan di folder
                                    assets/icons/</small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.misi.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Update label file input
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = e.target.files[0]?.name || 'Pilih file SVG baru (opsional)';
            e.target.nextElementSibling.innerText = fileName;
        });

        // Validasi tanggal
        document.getElementById('tanggal_mulai').addEventListener('change', function() {
            document.getElementById('tanggal_selesai').min = this.value;
        });
    </script>
@endsection
