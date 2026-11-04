<?php

declare(strict_types=1);

class Mahasiswa
{
    private string $nim;
    private string $nama;
    private string $fakultas;
    private string $prodi;
    private string $asalSekolah;
    private int $semester;

    public function __construct(
        int $semester,
        string $nim = "",
        string $nama = "",
        string $fakultas = "",
        string $prodi = "",
        string $asalSekolah = ""
    ) {
        $this->setSemester($semester);
        $this->setNim($nim);
        $this->setNama($nama);
        $this->setFakultas($fakultas);
        $this->setProdi($prodi);
        $this->setAsalSekolah($asalSekolah);
    }

    // --- Getter Methods ---

    public function getNim(): string
    {
        return $this->nim;
    }

    public function getNama(): string
    {
        return $this->nama;
    }

    public function getFakultas(): string
    {
        return $this->fakultas;
    }

    public function getProdi(): string
    {
        return $this->prodi;
    }

    public function getAsalSekolah(): string
    {
        return $this->asalSekolah;
    }

    public function getSemester(): int
    {
        return $this->semester;
    }

    // --- Setter Methods (dengan Validasi) ---

    public function setNim(string $nim): void
    {
        $nim = trim($nim);
        if ($nim === "") {
            throw new InvalidArgumentException("NIM wajib diisi.");
        }
        $this->nim = $nim;
    }

    public function setNama(string $nama): void
    {
        $nama = trim($nama);
        if ($nama === "") {
            throw new InvalidArgumentException("Nama wajib diisi.");
        }
        $this->nama = $nama;
    }

    public function setFakultas(string $fakultas): void
    {
        $fakultas = trim($fakultas);
        if ($fakultas === "") {
            throw new InvalidArgumentException("Fakultas wajib diisi.");
        }
        $this->fakultas = $fakultas;
    }

    public function setProdi(string $prodi): void
    {
        $prodi = trim($prodi);
        if ($prodi === "") {
            throw new InvalidArgumentException("Prodi wajib diisi.");
        }
        $this->prodi = $prodi;
    }

    public function setAsalSekolah(string $asalSekolah): void
    {
        $asalSekolah = trim($asalSekolah);
        if ($asalSekolah === "") {
            throw new InvalidArgumentException("Asal sekolah wajib diisi.");
        }
        $this->asalSekolah = $asalSekolah;
    }

    public function setSemester(int $semester): void
    {
        if ($semester < 1 || $semester > 14) {
            throw new InvalidArgumentException("Semester harus berada di antara 1 sampai 14.");
        }
        $this->semester = $semester;
    }
}