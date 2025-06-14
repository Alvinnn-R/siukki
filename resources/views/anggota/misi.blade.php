@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/misi.css') }}">

<!-- start modal misi -->
<!-- Modal -->
<div class="modal fade" id="MisiModal" tabindex="-1" aria-labelledby="MisiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header border-0">
        <h5 class="modal-title w-100 fw-bold" id="MisiModalLabel">Memulai Perjalanan Di SiUKKI</h5>
      </div>
      
      <img src="{{ asset('assets/images/modalmisi.png') }}" alt="Memulai Perjalanan" class="img-fluid mb-3">
      
      <div class="modal-body" style="height: 200px;">
        <p id="modalText"><strong>Ustadzah: {{ Auth::user()->nama }}, selamat datang di halaman misi. Kamu baru saja memulai perjalananmu di SiUKKI. Misi-misi ini adalah tantangan yang akan menguji ketekunan dan semangatmu untuk lebih aktif dalam kegiatan islami di kampus.</strong></p>
      </div>
      
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-primary-skip position-absolute start-0 bottom-0 m-3" style="min-width: 120px;" data-bs-dismiss="modal">Skip >></button>
        <button type="button" class="btn btn-primary-next position-absolute end-0 bottom-0 m-3" style="min-width: 120px;" id="btnNextMisiModal">Next</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var MisiModal = new bootstrap.Modal(document.getElementById('MisiModal'));
    MisiModal.show();
  });

  // modal misi
  const texts = [
        `<strong>{{ Auth::user()->nama }}: Tapi, Ustadzah, ada banyak misi yang harus saya pilih. Bagaimana saya tahu misi mana yang harus saya mulai?</strong>`,
        `<strong>Uztadzah: Tidak perlu khawatir, {{ Auth::user()->nama }}. Mulailah dari yang paling sederhana. Setiap misi di SiUKKI dirancang untuk membantumu meningkatkan kualitas ibadah dan keterlibatan di kampus. Misalnya, kamu bisa memulai dengan membaca Al-Qur'an atau sholat berjamaah.</strong>`,
        `<strong>{{ Auth::user()->nama }}: Jadi, semua misi ini penting ya, Ustadzah?</strong>`,
        `<strong>Ustadzah: Betul, {{ Auth::user()->nama }}. Setiap langkah kecil yang kamu ambil akan memberi manfaat besar. XP yang kamu kumpulkan adalah bukti perkembanganmu. Namun, yang lebih penting adalah niat dan konsistensi yang kamu tunjukkan.</strong>`,
        `<strong>Uztadzah: Sekarang, pilih misi yang paling sesuai dengan waktu dan semangatmu. Ingat, misi-misi ini bukan hanya untuk mendapatkan XP, tetapi juga untuk mendekatkan diri kepada Allah dan meningkatkan kontribusimu di UKKI.</strong>`,
        `<strong>{{ Auth::user()->nama }}: Terima kasih, Ustadzah. Saya akan mulai dengan yang pertama. Ayo, saya siap untuk memulai!</strong>`
    ];

    let currentStep = -1; // Mulai dari -1 karena kita akan menampilkan teks pertama pada klik pertama
    const modalText = document.getElementById('modalText');
    const nextBtn = document.getElementById('btnNextMisiModal');

    nextBtn.addEventListener('click', function () {
        currentStep++;
        if (currentStep < texts.length) {
            modalText.innerHTML = texts[currentStep];
        }

        if (currentStep === texts.length - 1) {
            nextBtn.innerText = 'Selesai';
        }

        if (currentStep >= texts.length) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('MisiModal'));
            modal.hide();
        }
    });

</script>
<!-- end modal misi -->

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
