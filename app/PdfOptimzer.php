<?php

namespace App;

class PdfOptimzer {
    private $lokasiFilePdf;

    private $tempatMenyimpan;

    private $extension;

    private $basename;

    private $lokasiFilePdfTerkompres;

    private $bin;

    /**
     * Konstruktor untuk kelas PdfOptimzer.
     *
     * @param string $lokasiFilePdf Lokasi file PDF yang akan dioptimasi.
     * @param string $tempatMenyimpan Lokasi untuk menyimpan file PDF yang telah dioptimasi.
     */
    public function __construct($lokasiFilePdf, $tempatMenyimpan, $bin = 'gswin64c') {
        if ($this->open($lokasiFilePdf)) {
            $this->setup($lokasiFilePdf, $tempatMenyimpan, $bin);
        }
    }

    private function open($lokasiFilePdf) {
        if (!file_exists($lokasiFilePdf)) {
            return false;
        }
        $this->lokasiFilePdf = $lokasiFilePdf;
        $this->extension = pathinfo($lokasiFilePdf, PATHINFO_EXTENSION);
        if ($this->extension != "pdf") {
            return false;
        }
        $this->basename = pathinfo($lokasiFilePdf, PATHINFO_BASENAME);
        return true;
    }

    private function cekDirektoriOutput($tempatMenyimpan) {
        if (!is_dir($tempatMenyimpan)) {
            return mkdir($tempatMenyimpan, 0777, true);
        }
        $this->tempatMenyimpan = $tempatMenyimpan;
        return true;
    }

    private function setup($lokasiFilePdf, $tempatMenyimpan, $bin) {
        if ($this->cekDirektoriOutput($tempatMenyimpan)) {
            $this->lokasiFilePdfTerkompres = $this->definisikanPathFileOutput($lokasiFilePdf, $tempatMenyimpan);
            $this->bin = $bin;
        }
    }

    private function definisikanPathFileOutput() {
        return $this->tempatMenyimpan .
        "/" .
        pathinfo($this->lokasiFilePdf, PATHINFO_FILENAME) .
            "_compressed.pdf";
    }

    private function perintahOptimasiPdf($lokasiFilePdf, $lokasiFilePdfTerkompres) {
        return "gswin64c -sDEVICE=pdfwrite -dPDFSETTINGS=/screen -dNOPAUSE -dQUIET -dBATCH -sOutputFile=" .
        escapeshellarg($lokasiFilePdfTerkompres) .
        " " .
        escapeshellarg($lokasiFilePdf) .
            " 2>&1";
    }

    private function jalankanPerintah($perintah) {
        exec($perintah, $hasil_perintah, $hasil);
        return $hasil;
    }

    public function convertPdf() {
        $perintah = $this->perintahOptimasiPdf($this->lokasiFilePdf, $this->lokasiFilePdfTerkompres);
        $hasil = $this->jalankanPerintah($perintah);
        if ($hasil == 0) {
            return $this->lokasiFilePdfTerkompres;
        } else {
            throw new \Exception("Gagal mengoptimalkan file PDF.");
        }
    }

}