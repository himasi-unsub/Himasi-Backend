<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DokumenSertifikat;
use App\Models\PesertaKegiatan;
use App\Models\PesertaMabim;
use App\Models\PesertaMakrab;
use App\TemplateProcessor;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class GenerateSertifikat extends Controller
{
    public function generateSertifikat(?string $kegiatan = null, ?int $peserta = null)
    {
        if ('mabim' == $kegiatan) {
            $peserta             = PesertaMabim::with('mabim.mahasiswa')->with('mahasiswa')->findOrFail($peserta);
            $ketua_pelaksana     = $peserta->mabim->mahasiswa->nama;
            $dokumenSertifikatId = DokumenSertifikat::findOrFail($peserta->mabim->id_dokumen_sertifikat);
        } else if ('makrab' == $kegiatan) {
            $peserta             = PesertaMakrab::with('makrab.mahasiswa')->with('mahasiswa')->findOrFail($peserta);
            $ketua_pelaksana     = $peserta->makrab->mahasiswa->nama;
            $dokumenSertifikatId = DokumenSertifikat::findOrFail($peserta->makrab->id_dokumen_sertifikat);
        } else if ('lainnya' == $kegiatan) {
            $peserta             = PesertaKegiatan::with('kegiatanAcara.mahasiswa')->with('mahasiswa')->findOrFail($peserta);
            $ketua_pelaksana     = $peserta->kegiatanAcara->mahasiswa->nama;
            $dokumenSertifikatId = DokumenSertifikat::findOrFail($peserta->kegiatanAcara->id_dokumen_sertifikat);
        } else {
            return response()->json([
                'message' => 'Jenis kegiatan tidak ditemukan!',
             ], 404);
        }

        // Check if file exists
        if (! Storage::disk('public')->exists($dokumenSertifikatId->file)) {
            return redirect()->back()->with("error", "File template tidak ditemukan!")->withInput();
        }

        // generate QR Code
        $qr_code_result = $this->__generateQrCode($kegiatan, $peserta);

        // Template Processor DOCX file
        $template_processor = new TemplateProcessor(storage_path('app/public/' . $dokumenSertifikatId->file));

        // Set value to template
        $template_processor->setValue('NAMA', $peserta->mahasiswa->nama);
        $template_processor->setValue('KETUA_PELAKSANA', $ketua_pelaksana);

        // set qr code image
        $template_processor->setImageValue('QR_CODE', [
            'path'   => storage_path('app/public/' . $qr_code_result),
            'width'  => 100,
            'height' => 100,
         ]);

        // Set file location
        $file_name     = 'sertifikat-' . $kegiatan . '-' . $peserta->mahasiswa->npm . '-' . $peserta->mahasiswa->nama;
        $file_location = 'sertifikat/' . $kegiatan . '/' . $file_name;

        try {
            // Create directory if not exists
            if (! Storage::disk('public')->exists('sertifikat/' . $kegiatan)) {
                Storage::disk('public')->makeDirectory('sertifikat/' . $kegiatan);
            }

            // Save DOCX file
            $template_processor->saveAs(storage_path('app/public/' . $file_location . '.docx'));
        } catch (\Exception $e) {
            // return redirect()->back()->with("error", "Gagal menyimpan file sertifikat!")->withInput();
            // dd($e->getMessage());
            return response()->json([
                'message' => 'Gagal menyimpan file sertifikat!',
                'error'   => $e->getMessage(),
             ], 500);
        }

        // delete QR Code image
        Storage::disk('public')->delete($qr_code_result);

        return response()->download(storage_path('app/public/' . $file_location . '.docx'))->deleteFileAfterSend(true);
    }

    public function bulkBatchGenerateSertifikat(?string $kegiatan = null, $records = null)
    {
        // $records is JSON string
        $records = json_decode($records);

        if ('mabim' == $kegiatan) {
            $pesertas            = PesertaMabim::with('mabim.mahasiswa')->with('mahasiswa')->findMany($records);
            $ketua_pelaksana     = $pesertas[ 0 ]->mabim->mahasiswa->nama;
            $dokumenSertifikatId = DokumenSertifikat::findOrFail($pesertas[ 0 ]->mabim->id_dokumen_sertifikat);
        } else if ('makrab' == $kegiatan) {
            $pesertas            = PesertaMakrab::with('makrab')->with('mahasiswa')->findMany($records);
            $ketua_pelaksana     = $pesertas[ 0 ]->makrab->mahasiswa->nama;
            $dokumenSertifikatId = DokumenSertifikat::findOrFail($pesertas[ 0 ]->makrab->id_dokumen_sertifikat);
        } else if ($kegiatan = 'lainnya') {
            $pesertas            = PesertaKegiatan::with('kegiatanAcara.mahasiswa')->with('mahasiswa')->findMany($records);
            $ketua_pelaksana     = $pesertas[ 0 ]->kegiatanAcara->mahasiswa->nama;
            $dokumenSertifikatId = DokumenSertifikat::findOrFail($pesertas[ 0 ]->kegiatanAcara->id_dokumen_sertifikat);
        } else {
            return response()->json([
                'message' => 'Jenis kegiatan tidak ditemukan!',
             ], 404);
        }

        // Check permission folder
        if (! Storage::disk('public')->exists('sertifikat/' . $kegiatan)) {
            Storage::disk('public')->makeDirectory('sertifikat/' . $kegiatan);
            chmod(storage_path('app/public/sertifikat/' . $kegiatan), 0777);
        } else {
            chmod(storage_path('app/public/sertifikat/' . $kegiatan), 0777);
        }

        // check if peserta mabim is empty
        if ($pesertas->isEmpty()) {
            return response()->json([
                'message' => 'Tidak ada peserta MABIM!',
             ], 404);
        }

        // create new ZIP file
        $zip               = new \ZipArchive();
        $zip_file_name     = 'sertifikat-' . $kegiatan . '-' . now()->format('Y-m-d-H-i-s') . '.zip';
        $zip_file_location = 'sertifikat/' . $kegiatan . '/' . $zip_file_name;

        // create new ZIP file
        if ($zip->open(storage_path('app/public/' . $zip_file_location), \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            return response()->json([
                'message' => 'Gagal membuat file ZIP!',
             ], 500);
        }

        // loop through peserta mabim
        foreach ($pesertas as $peserta) {

            // Check if file exists
            if (! Storage::disk('public')->exists($dokumenSertifikatId->file)) {
                return response()->json([
                    'message' => 'File template tidak ditemukan!',
                 ], 404);
            }

            // generate QR Code
            $qr_code_result = $this->__generateQrCode($kegiatan, $peserta);

            // Template Processor DOCX file
            $template_processor = new TemplateProcessor(storage_path('app/public/' . $dokumenSertifikatId->file));

            // Set value to template
            $template_processor->setValue('NAMA', $peserta->mahasiswa->nama);
            $template_processor->setValue('KETUA_PELAKSANA', $ketua_pelaksana);

            // set qr code image
            $template_processor->setImageValue('QR_CODE', [
                'path'   => storage_path('app/public/' . $qr_code_result),
                'width'  => 100,
                'height' => 100,
             ]);

            // Set file location
            $file_name     = 'sertifikat-' . $kegiatan . '-' . $peserta->mahasiswa->npm . '-' . $peserta->mahasiswa->nama;
            $file_location = 'sertifikat/' . $kegiatan . '/' . $file_name;

            try {
                // Save DOCX file
                $template_processor->saveAs(storage_path('app/public/' . $file_location . '.docx'));

                // Add file to ZIP
                try {
                    $zip->addFile(storage_path('app/public/' . $file_location . '.docx'), $file_name . '.docx');
                } catch (\Exception $e) {
                    return response()->json([
                        'message' => 'Gagal menambahkan file sertifikat ke dalam ZIP!',
                        'error'   => $e->getMessage(),
                     ], 500);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Gagal menyimpan file sertifikat!',
                    'error'   => $e->getMessage(),
                 ], 500);
            }

            // delete QR Code image
            Storage::disk('public')->delete($qr_code_result);

        }

        // close ZIP file
        try {
            if ($zip->numFiles > 0) {
                $zip->close();
            } else {
                $zip->close();
                Storage::disk('public')->delete($zip_file_location);
                return response()->json([
                    'message' => 'Tidak ada file yang ditambahkan ke dalam ZIP!',
                 ], 404);
            }
            // delete DOCX file
            foreach ($pesertas as $peserta) {
                $file_name     = 'sertifikat-' . $kegiatan . '-' . $peserta->mahasiswa->npm . '-' . $peserta->mahasiswa->nama;
                $file_location = 'sertifikat/' . $kegiatan . '/' . $file_name;
                // delete DOCX file
                Storage::disk('public')->delete($file_location . '.docx');
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menutup file ZIP!',
                'error'   => $e->getMessage(),
             ], 500);
        }

        return response()->download(storage_path('app/public/' . $zip_file_location))->deleteFileAfterSend(true);

    }

    protected function __generateQrCode($kegiatan, $peserta)
    {
        if (! $peserta) {
            return response()->json([
                'message' => 'Peserta tidak ditemukan!',
             ], 404);
        }

        // make directory if not exists
        if (! Storage::disk('public')->exists('qr-code')) {
            mkdir(storage_path('app/public/qr-code'), 0755, true);
        }

        $writter = new PngWriter();

        $qr_code = new QrCode(
            data: route('verifikasi-sertifikat', [ 'sha256' => Crypt::encryptString($peserta->mahasiswa->npm) ]),
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::Medium,
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            foregroundColor: new Color(0, 0, 0),
            backgroundColor: new Color(255, 255, 255, 100)
        );

        $result = $writter->write($qr_code);

        $storage_path = 'qr-code/' . $kegiatan . '-' . $peserta->mahasiswa->npm . '.png';
        $result->saveToFile(storage_path('app/public/' . $storage_path));

        return $storage_path;
    }
}