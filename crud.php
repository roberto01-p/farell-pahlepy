<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pengelolaan Data Mahasiswa</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f6f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      padding: 30px 0;
    }
    .card-custom {
      border: none;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .form-label {
      font-weight: 600;
      font-size: 0.85rem;
      color: #333;
    }
    .table-custom th {
      background-color: #eef2f7;
      color: #333;
      font-weight: 600;
      font-size: 0.85rem;
      vertical-align: middle;
    }
    .table-custom td {
      font-size: 0.85rem;
      vertical-align: middle;
    }
    .btn-primary-custom {
      background-color: #0b5ed7;
      border: none;
    }
    .btn-primary-custom:hover {
      background-color: #0a58ca;
    }
    .text-muted-footer {
      font-size: 0.75rem;
      color: #888;
    }
  </style>
</head>
<body>

  <div class="container" style="max-width: 950px;">
    
    <!-- Alert Notifikasi -->
    <div id="alertSuccess" class="alert alert-success border-0 shadow-sm mb-4" role="alert" style="display: none; background-color: #d1e7dd; color: #0f5132;">
      Data berhasil ditambahkan.
    </div>

    <!-- Card Form Tambah Data -->
    <div class="card card-custom p-4 mb-4 bg-white">
      <h5 class="fw-bold mb-4" style="color: #1a2530;">Tambah Data Mahasiswa</h5>
      <form id="formMahasiswa">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">NIM</label>
            <input type="text" class="form-control form-control-sm" id="nim" required />
          </div>
          <div class="col-md-6">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control form-control-sm" id="nama" required />
          </div>

          <div class="col-md-6">
            <label class="form-label">Fakultas</label>
            <input type="text" class="form-control form-control-sm" id="fakultas" required />
          </div>
          <div class="col-md-6">
            <label class="form-label">Program Studi</label>
            <input type="text" class="form-control form-control-sm" id="prodi" required />
          </div>

          <div class="col-md-6">
            <label class="form-label">Asal Sekolah</label>
            <input type="text" class="form-control form-control-sm" id="asalSekolah" required />
          </div>
          <div class="col-md-6">
            <label class="form-label">Semester</label>
            <input type="number" class="form-control form-control-sm" id="semester" required />
          </div>

          <div class="col-md-6">
            <label class="form-label">Hobi</label>
            <input type="text" class="form-control form-control-sm" id="hobi" required />
          </div>
          <div class="col-md-6">
            <label class="form-label">Agama</label>
            <select class="form-select form-select-sm" id="agama" required>
              <option value="" selected disabled>-- Pilih Agama --</option>
              <option value="Islam">Islam</option>
              <option value="Kristen">Kristen</option>
              <option value="Katolik">Katolik</option>
              <option value="Hindu">Hindu</option>
              <option value="Buddha">Buddha</option>
              <option value="Konghucu">Konghucu</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">Jenis Mahasiswa</label>
            <select class="form-select form-select-sm" id="jenisMahasiswa" required>
              <option value="Reguler" selected>Reguler</option>
              <option value="Beasiswa">Beasiswa</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">UKT (Rp)</label>
            <input type="number" class="form-control form-control-sm" id="ukt" value="0" min="0" required />
          </div>
        </div>

        <button type="submit" class="btn btn-primary-custom btn-sm px-3 mt-4 text-white">Tambah Mahasiswa</button>
      </form>
    </div>

    <!-- Card Tabel Data -->
    <div class="card card-custom p-4 bg-white">
      <h6 class="fw-bold mb-3" style="color: #1a2530;">
        Daftar Mahasiswa (<span id="totalData">0</span> dari <span id="totalAllData">0</span>)
      </h6>

      <!-- Form Cari -->
      <div class="row mb-3">
        <div class="col-md-5 d-flex gap-2">
          <input type="text" id="inputCari" class="form-control form-control-sm" placeholder="Cari NIM, nama, prodi, fakultas, jenis..." />
          <button class="btn btn-primary-custom btn-sm text-white px-3" onclick="renderTable()">Cari</button>
        </div>
      </div>

      <!-- Tabel -->
      <div class="table-responsive">
        <table class="table table-bordered table-custom text-nowrap">
          <thead>
            <tr>
              <th>NIM</th>
              <th>Nama</th>
              <th>Fakultas</th>
              <th>Prodi</th>
              <th>Asal Sekolah</th>
              <th>Semester</th>
              <th>Hobi</th>
              <th>Agama</th>
              <th>Jenis</th>
              <th>UKT</th>
              <th>Potongan</th>
              <th>Biaya Akhir</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="tbodyMahasiswa">
            <!-- Data dimasukkan via JS -->
          </tbody>
        </table>
      </div>

      <p class="text-muted-footer mt-2 mb-0">
        Data disimpan sementara menggunakan JS (tanpa database MySQL). Pencarian mencakup NIM, nama, prodi, fakultas, dan jenis mahasiswa.
      </p>
    </div>

  </div>

  <script>
    // Data Default Sesuai Gambar
    let dataMahasiswa = [
      {
        nim: "2305021020",
        nama: "APENN",
        fakultas: "Saintek",
        prodi: "Teknik Informatika",
        asalSekolah: "SMKN 1 KOTA SUKABUMI",
        semester: 3,
        hobi: "DANCE",
        agama: "Islam",
        jenis: "Reguler",
        ukt: 5000000
      }
    ];

    const form = document.getElementById('formMahasiswa');
    const alertSuccess = document.getElementById('alertSuccess');

    // Format mata uang Rupiah
    function formatRupiah(angka) {
      return 'Rp ' + Number(angka).toLocaleString('id-ID');
    }

    // Fungsi Render/Tampil Data ke Tabel
    function renderTable() {
      const keyword = document.getElementById('inputCari').value.toLowerCase();
      const tbody = document.getElementById('tbodyMahasiswa');
      tbody.innerHTML = '';

      let filteredData = dataMahasiswa.filter(mhs => {
        return mhs.nim.toLowerCase().includes(keyword) ||
               mhs.nama.toLowerCase().includes(keyword) ||
               mhs.prodi.toLowerCase().includes(keyword) ||
               mhs.fakultas.toLowerCase().includes(keyword) ||
               mhs.jenis.toLowerCase().includes(keyword);
      });

      document.getElementById('totalData').innerText = filteredData.length;
      document.getElementById('totalAllData').innerText = dataMahasiswa.length;

      filteredData.forEach((mhs, index) => {
        // Kalkulasi Potongan & Biaya Akhir
        let persenPotongan = mhs.jenis === 'Beasiswa' ? 0.20 : 0.00;
        let nominalPotongan = mhs.ukt * persenPotongan;
        let biayaAkhir = mhs.ukt - nominalPotongan;

        let tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${mhs.nim}</td>
          <td>${mhs.nama}</td>
          <td>${mhs.fakultas}</td>
          <td>${mhs.prodi}</td>
          <td>${mhs.asalSekolah}</td>
          <td>${mhs.semester}</td>
          <td>${mhs.hobi}</td>
          <td>${mhs.agama}</td>
          <td>${mhs.jenis}</td>
          <td>${formatRupiah(mhs.ukt)}</td>
          <td>${(persenPotongan * 100).toFixed(2)}%</td>
          <td class="fw-bold">${formatRupiah(biayaAkhir)}</td>
          <td>
            <button class="btn btn-sm btn-primary py-0 px-2 style="font-size: 0.75rem;">Edit</button>
            <button class="btn btn-sm btn-danger py-0 px-2" style="font-size: 0.75rem;" onclick="hapusData(${index})">Hapus</button>
          </td>
        `;
        tbody.appendChild(tr);
      });
    }

    // Handle Submit Form Tambah Mahasiswa
    form.addEventListener('submit', function(e) {
      e.preventDefault();

      const newMhs = {
        nim: document.getElementById('nim').value,
        nama: document.getElementById('nama').value,
        fakultas: document.getElementById('fakultas').value,
        prodi: document.getElementById('prodi').value,
        asalSekolah: document.getElementById('asalSekolah').value,
        semester: document.getElementById('semester').value,
        hobi: document.getElementById('hobi').value,
        agama: document.getElementById('agama').value,
        jenis: document.getElementById('jenisMahasiswa').value,
        ukt: parseFloat(document.getElementById('ukt').value) || 0
      };

      dataMahasiswa.push(newMhs);
      renderTable();

      // Tampilkan Alert Success
      alertSuccess.style.display = 'block';
      setTimeout(() => {
        alertSuccess.style.display = 'none';
      }, 3000);

      // Reset Form
      form.reset();
      document.getElementById('jenisMahasiswa').value = 'Reguler';
      document.getElementById('ukt').value = '0';
    });

    // Fungsi Hapus Data
    function hapusData(index) {
      if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        dataMahasiswa.splice(index, 1);
        renderTable();
      }
    }

    // Render pertama kali saat halaman dimuat
    renderTable();
  </script>
</body>
</html>