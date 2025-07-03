@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/misi.css') }}">

    <!-- start modal misi -->
    <!-- Modal -->
    <div class="modal fade" id="MisiModal" tabindex="-1" aria-labelledby="MisiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-color text-center">
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 fw-bold" id="MisiModalLabel">Mengerjakan Misi Di SiUKKI</h5>
                </div>

                <img src="{{ asset('assets/images/modalmisi.png') }}" alt="Memulai Perjalanan" class="img-fluid mb-3">

                <div class="modal-body" style="height: 230px;">
                    <p id="modalText"><strong>Ustadzah: "Assalamu’alaikum <strong>{{ Auth::user()->nama }}</strong>, Selamat
                            datang di
                            halaman misi. Perjalananmu di SiUKKI baru saja dimulai. Setiap misi adalah tantangan untuk
                            melatih ketekunan dan semangatmu dalam kegiatan Islami di kampus."</strong></p>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-primary-skip position-absolute start-0 bottom-0 m-3"
                        style="min-width: 120px;" data-bs-dismiss="modal">Skip >></button>
                    <button type="button" class="btn btn-primary-next position-absolute end-0 bottom-0 m-3"
                        style="min-width: 120px;" id="btnNextMisiModal">Next</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var MisiModal = new bootstrap.Modal(document.getElementById('MisiModal'));
            MisiModal.show();
        });

        // modal misi
        const texts = [
            `<strong>{{ Auth::user()->nama }}: "Tapi Ustadzah, ada banyak misi. Bagaimana saya tahu harus mulai dari yang mana?"</strong>`,
            `<strong>Uztadzah: "Tidak perlu khawatir, <strong>{{ Auth::user()->nama }}</strong>. Mulailah dari misi yang paling mudah. Semua misi di SiUKKI dirancang untuk membantumu meningkatkan ibadah dan keterlibatan di kampus. Misalnya, kamu bisa mulai dengan membaca Al-Qur’an atau sholat berjamaah."</strong>`,
            `<strong>{{ Auth::user()->nama }}: "Jadi, semua misi ini penting, ya Ustadzah?"</strong>`,
            `<strong>Ustadzah: "Betul, <strong>{{ Auth::user()->nama }}</strong>. Setiap langkah kecil membawa manfaat besar. XP yang kamu kumpulkan menunjukkan perkembanganmu. Tapi yang paling penting adalah niat dan konsistensimu."</strong>`,
            `<strong>Uztadzah: "Sekarang, pilih misi yang sesuai dengan waktumu dan semangatmu. Ingat, misi ini bukan sekadar XP, tapi juga jalan untuk mendekat kepada Allah dan berkontribusi di UKKI."</strong>`,
            `<strong>{{ Auth::user()->nama }}: "Terima kasih, Ustadzah. Saya siap memulai misi pertama!"</strong>`
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
            @foreach ($misiHarian as $misi)
                <div class="col">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <img class="material-icons misi-icon" src="{{ asset('uploads/icon/' . $misi->icon) }}" width="50%">
                            <h5 class="card-title mt-2">{{ $misi->nama_misi }}</h5>
                            @if ($misi->is_checkin)
                                @if ($misi->is_completed)
                                    {{-- Jika misi check-in dan sudah selesai --}}
                                    <button class="btn btn-secondary" disabled>Check-In Berhasil</button>
                                @else
                                    {{-- Jika misi check-in dan belum selesai --}}
                                    <button class="btn btn-success btn-checkin" data-bs-toggle="modal" data-bs-target="#checkinModal"
                                        data-id="{{ $misi->id_misi }}" data-xp="{{ $misi->xp_reward }}">
                                        Check-in
                                    </button>
                                @endif
                            @elseif($misi->is_completed)
                                {{-- Misi harian biasa tapi sudah diselesaikan --}}
                                <button class="btn btn-secondary" disabled>Misi Selesai</button>
                            @else
                                {{-- Misi harian biasa dan belum selesai --}}
                                <button class="btn btn-success btn-selesaikan-misi" data-bs-toggle="modal"
                                    data-bs-target="#misiModalHarian" data-id="{{ $misi->id_misi }}"
                                    data-judul="{{ $misi->nama_misi }}" data-xp="{{ $misi->xp_reward }}"
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
            @foreach ($misiEvent as $misi)
                <div class="col">
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <img class="material-icons misi-icon" src="{{ asset('uploads/icon/' . $misi->icon) }}" width="50%">
                            <h5 class="card-title mt-2">{{ $misi->nama_misi }}</h5>
                            @if ($misi->is_completed)
                                {{-- Misi event sudah diselesaikan --}}
                                <button class="btn btn-secondary" disabled>Misi Selesai</button>
                            @else
                                {{-- Misi event belum selesai --}}
                                <button class="btn btn-success btn-selesaikan-misi" data-bs-toggle="modal"
                                    data-bs-target="#misiModalTerbatas" data-id="{{ $misi->id_misi }}"
                                    data-judul="{{ $misi->nama_misi }}" data-icon="{{ $misi->icon }}"
                                    data-xp="{{ $misi->xp_reward }}" data-deskripsi="{{ $misi->deskripsi }}">
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
            <div class="modal-content modal-content-color text-center modal-misi-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 fw-bold" id="checkinModalLabel">Check-in Harian</h5>
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="xp-display mb-3">+<span id="checkinXP">0</span> XP</div>
                    <p class="text-muted mb-0">Terima kasih sudah check-in hari ini!</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Misi Harian -->
    <div class="modal fade" id="misiModalHarian" tabindex="-1" aria-labelledby="misiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-color modal-misi-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center" id="misiModalLabel">Misi Harian</h5>
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body position-relative">
                    <div class="section-title">Deskripsi</div>
                    <div class="description-box">
                        <span id="misiDeskripsi">Deskripsi Misi</span>
                    </div>

                    <div class="section-title">Reward</div>
                    <div class="reward-box">
                        <span id="misiXP">0xp</span> <!-- Tambahkan elemen dengan id misiXP -->
                    </div>

                    <button id="btnSelesaikanMisi" class="btn btn-selesaikan-modal">Selesaikan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Misi Terbatas -->
    <div class="modal fade" id="misiModalTerbatas" tabindex="-1" aria-labelledby="misiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-color modal-misi-content text-center">
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 fw-bold" id="misiModalLabel">Nama Misi</h5>
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body position-relative pb-5">
                    <!-- Menampilkan Ikon Misi -->
                    <img src="{{ asset('uploads/icon/' . $misi->icon) }}" alt="ikonMisi" class="img-fluid mb-3"
                        style="width: 50%;">
                    <!-- Menampilkan XP -->
                    <div class="xp-display text-center mb-3" id="misiXP">+0 XP</div>

                    <!-- Deskripsi Misi -->
                    <p class="text-muted mb-3" id="misiDeskripsi">Deskripsi misi akan muncul di sini.</p>

                    <!-- Tombol Selesaikan -->
                    <button id="btnSelesaikanMisi" class="btn btn-success">Selesaikan</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // ------------------------- MODAL MISI HARIAN & TERBATAS -------------------------
            // Modal Harian
            const modalMisiHarian = document.getElementById('misiModalHarian');
            const btnModalSelesaiHarian = modalMisiHarian.querySelector('#btnSelesaikanMisi');
            // Modal Terbatas
            const modalMisiTerbatas = document.getElementById('misiModalTerbatas');
            const btnModalSelesaiTerbatas = modalMisiTerbatas.querySelector('#btnSelesaikanMisi');

            // Handler untuk modal harian
            modalMisiHarian.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const judul = button.getAttribute('data-judul');
                const xp = parseInt(button.getAttribute('data-xp')) || 0;
                const deskripsi = button.getAttribute('data-deskripsi');
                const idMisi = button.getAttribute('data-id');

                modalMisiHarian.querySelector('#misiModalLabel').textContent = judul;
                modalMisiHarian.querySelector('#misiXP').textContent = `+${xp} XP`;
                modalMisiHarian.querySelector('#misiDeskripsi').textContent = deskripsi;
                btnModalSelesaiHarian.setAttribute('data-id', idMisi);
            });

            btnModalSelesaiHarian.addEventListener('click', () => {
                const idMisi = btnModalSelesaiHarian.getAttribute('data-id');
                fetch(`/anggota/misi/${idMisi}/complete`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({})
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            bootstrap.Modal.getInstance(modalMisiHarian).hide();
                            const tombolTerkait = document.querySelectorAll(
                                `.btn-selesaikan-misi[data-id="${idMisi}"]`);
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

            // Handler untuk modal terbatas
            modalMisiTerbatas.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const judul = button.getAttribute('data-judul');
                const xp = parseInt(button.getAttribute('data-xp')) || 0;
                const deskripsi = button.getAttribute('data-deskripsi');
                const idMisi = button.getAttribute('data-id');
                const ikonMisi = button.getAttribute('data-icon');

                modalMisiTerbatas.querySelector('#misiModalLabel').textContent = judul;
                modalMisiTerbatas.querySelector('#misiXP').textContent = `+${xp} XP`;
                modalMisiTerbatas.querySelector('#misiDeskripsi').textContent = deskripsi;
                btnModalSelesaiTerbatas.setAttribute('data-id', idMisi);
                modalMisiTerbatas.querySelector('img').src = 'uploads/icon/' +
                    ikonMisi;
                // imageElement.src = asset('uploads/icon/' + ikonMisi);
            });

            btnModalSelesaiTerbatas.addEventListener('click', () => {
                const idMisi = btnModalSelesaiTerbatas.getAttribute('data-id');
                fetch(`/anggota/misi/${idMisi}/complete`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({})
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            bootstrap.Modal.getInstance(modalMisiTerbatas).hide();
                            const tombolTerkait = document.querySelectorAll(
                                `.btn-selesaikan-misi[data-id="${idMisi}"]`);
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
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
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
                    body: JSON.stringify({
                        id_misi: idMisi
                    }) // ID dikirim sebagai JSON
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // Cari semua tombol check-in yang memiliki ID misi ini
                            const tombolCheckin = document.querySelectorAll(
                                `.btn-checkin[data-id="${idMisi}"]`);
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