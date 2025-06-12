@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/misi.css') }}">
<div class="misi-container container">
    <h2 class="text-center">Misi</h2>

    <!-- Misi Harian -->
    <h4 class="border-bottom border-3 pb-2 mb-4">Misi Harian</h4>
    <div class="row row-cols-2 row-cols-md-4 g-4">
        @foreach($misiHarian as $misi)
        <div class="col">
            <div class="card h-100 text-center">
                <div class="card-body">
                  <span class="material-icons misi-icon">{{ $misi->icon }}</span>
                    <h5 class="card-title mt-2">{{ $misi->nama_misi }}</h5>
                    @if($misi->is_checkin)
                    @if($misi->is_completed)
                        {{-- Jika misi check-in dan sudah selesai --}}
                        <button class="btn btn-secondary" disabled>Check-In Berhasil</button>
                    @else
                        {{-- Jika misi check-in dan belum selesai --}}
                        <button class="btn btn-success btn-checkin"
                            data-bs-toggle="modal"
                            data-bs-target="#checkinModal"
                            data-id="{{ $misi->id_misi }}"
                            data-xp="{{ $misi->xp_reward }}">
                            Check-in
                        </button>
                    @endif
                @elseif($misi->is_completed)
                    {{-- Misi harian biasa tapi sudah diselesaikan --}}
                    <button class="btn btn-secondary" disabled>Misi Selesai</button>
                @else
                    {{-- Misi harian biasa dan belum selesai --}}
                    <button class="btn btn-success btn-selesaikan-misi"
                        data-bs-toggle="modal"
                        data-bs-target="#misiModal"
                        data-id="{{ $misi->id_misi }}"
                        data-judul="{{ $misi->nama_misi }}"
                        data-xp="{{ $misi->xp_reward }}"
                        data-deskripsi="{{ $misi->deskripsi }}">
                        Selesaikan Misi
                    </button>
                @endif                
              </div>
            </div>
        </div>
        @endforeach
     </div>

    <!-- Misi Terbatas -->
    <h4 class="mt-4 border-bottom border-3 pb-2 mb-4">Misi Terbatas</h4>
    <div class="row row-cols-2 row-cols-md-4 g-4">
        @foreach($misiEvent as $misi)
        <div class="col">
            <div class="card h-100 text-center">
                <div class="card-body">
                  <span class="material-icons misi-icon">{{ $misi->icon }}</span>
                    <h5 class="card-title mt-2">{{ $misi->nama_misi }}</h5>
                    @if($misi->is_completed)
                    {{-- Misi event sudah diselesaikan --}}
                    <button class="btn btn-secondary" disabled>Misi Selesai</button>
                @else
                    {{-- Misi event  belum selesai --}}
                    <button class="btn btn-success btn-selesaikan-misi"
                        data-bs-toggle="modal"
                        data-bs-target="#misiModal"
                        data-id="{{ $misi->id_misi }}"
                        data-judul="{{ $misi->nama_misi }}"
                        data-xp="{{ $misi->xp_reward }}"
                        data-deskripsi="{{ $misi->deskripsi }}">
                        Selesaikan Misi
                    </button>
                @endif                
              </div>
            </div>
        </div>
        @endforeach
</div>
</div>

<!-- Modal Check-in -->
<div class="modal fade" id="checkinModal" tabindex="-1" aria-labelledby="checkinModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center modal-misi-content">
      <div class="modal-header border-0">
        <h5 class="modal-title w-100 fw-bold" id="checkinModalLabel">Check-in Harian</h5>
        <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="xp-display mb-3">+<span id="checkinXP">0</span> XP</div>
        <p class="text-muted mb-0">Terima kasih sudah check-in hari ini!</p>
      </div>
    </div>
  </div>
</div>


  
  <!-- Modal Misi -->
  <div class="modal fade" id="misiModal" tabindex="-1" aria-labelledby="misiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modal-misi-content text-center">
        <div class="modal-header border-0">
          <h5 class="modal-title w-100 fw-bold" id="misiModalLabel">Nama Misi</h5>
          <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body position-relative pb-5">
          <div class="xp-display text-center mb-3" id="misiXP">+0 XP</div>       
          <button id="btnSelesaikanMisi" class="btn btn-success">Selesaikan</button>
        </div>        
      </div>
    </div>
  </div>
  
  <script>
    document.addEventListener('DOMContentLoaded', () => {
        // ------------------------- MODAL MISI -------------------------
        const modalMisi = document.getElementById('misiModal');
        const btnModalSelesai = document.getElementById('btnSelesaikanMisi');

        // Saat modal akan muncul
        modalMisi.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            // Ambil atribut dari tombol pemicu
            const judul = button.getAttribute('data-judul');
            const xp = parseInt(button.getAttribute('data-xp')) || 0;
            const deskripsi = button.getAttribute('data-deskripsi');
            const idMisi = button.getAttribute('data-id');

            // Set isi modal
            document.getElementById('misiModalLabel').textContent = judul;
            document.getElementById('misiXP').textContent = `+${xp} XP`;
            if (document.getElementById('misiDeskripsi')) {
                document.getElementById('misiDeskripsi').textContent = deskripsi;
            }

            // Simpan ID misi ke tombol di dalam modal
            btnModalSelesai.setAttribute('data-id', idMisi);
        });

        // Ketika tombol di dalam modal diklik
        btnModalSelesai.addEventListener('click', () => {
            const idMisi = btnModalSelesai.getAttribute('data-id');

            fetch(`/anggota/misi/${idMisi}/complete`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Token keamanan
                },
                body: JSON.stringify({})
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Tutup modal
                    bootstrap.Modal.getInstance(modalMisi).hide();

                    // Temukan semua tombol yang punya data-id sama, lalu update tampilannya
                    // Temukan tombol di luar modal (class btn-selesaikan-misi) saja
                  const tombolTerkait = document.querySelectorAll(`.btn-selesaikan-misi[data-id="${idMisi}"]`);
                    tombolTerkait.forEach(button => {
                        button.textContent = 'Misi Selesai';
                        button.classList.remove('btn-success');
                        button.classList.add('btn-secondary');
                        button.setAttribute('disabled', true);
                        button.removeAttribute('data-bs-toggle');
                        button.removeAttribute('data-bs-target');
                    });
                } else {
                    alert(data.message || 'Gagal menyelesaikan misi.');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan saat menyelesaikan misi.');
            });
        });
    
      // ------------------------- MODAL CHECK-IN -------------------------
      const modalCheckin = document.getElementById('checkinModal');

      // Saat modal check-in ditampilkan, ambil data dari tombol yang men-trigger
      modalCheckin.addEventListener('show.bs.modal', function (event) {
          const button = event.relatedTarget;
          const xp = parseInt(button.getAttribute('data-xp')) || 0;
          const idMisi = button.getAttribute('data-id');

          // Tampilkan XP di modal
          document.getElementById('checkinXP').textContent = xp;

          // Kirim POST request ke server untuk check-in
          fetch('/anggota/misi/checkin', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF dari Laravel
              },
              body: JSON.stringify({ id_misi: idMisi }) // ID dikirim sebagai JSON
          })
          .then(res => res.json())
          .then(data => {
              if (data.success) {
                  // Cari semua tombol check-in yang memiliki ID misi ini
                  const tombolCheckin = document.querySelectorAll(`.btn-checkin[data-id="${idMisi}"]`);
                  tombolCheckin.forEach(btn => {
                      btn.textContent = 'Check-In Berhasil';
                      btn.classList.remove('btn-success');
                      btn.classList.add('btn-secondary');
                      btn.setAttribute('disabled', true);
                      btn.removeAttribute('data-bs-toggle');
                      btn.removeAttribute('data-bs-target');
                  });
              } else {
                  alert(data.message || 'Gagal check-in.');
              }
          })
          .catch(err => {
              console.error(err);
              alert('Terjadi kesalahan saat check-in.');
          });
      });
    });
    </script>
    
  

    
@endsection
