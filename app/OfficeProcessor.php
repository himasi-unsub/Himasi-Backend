<?php

namespace App;

trait OfficeProcessor {
    //
    /**
     * Mengambil variabel template dari file Word.
     *
     * Fungsi ini membaca file template Word yang diberikan dan mengekstrak semua variabel
     * yang ada di dalamnya. Variabel diidentifikasi dengan pola '${...}' dan disimpan dalam
     * array yang dikembalikan oleh fungsi ini.
     *
     * @param string $lokasiTemplate Lokasi file template Word yang akan dibaca.
     * @return array Daftar variabel yang ditemukan dalam template.
     */
    public function ambilVariabelTemplate($lokasiTemplate): array {
        $dataVar = [];
        // read template file
        $reader = \PhpOffice\PhpWord\IOFactory::createReader('Word2007');
        $phpWord = $reader->load(storage_path('app/public/' . $lokasiTemplate));
        $section = $phpWord->getSections();
        foreach ($section as $s) {
            $elements = $s->getElements();
            // dd($elements);
            foreach ($elements as $element) {
                // echo "TextRun: " . (get_class($element) == 'PhpOffice\PhpWord\Element\TextRun' ? 'true' : 'false') . "<br>";
                if (get_class($element) == 'PhpOffice\PhpWord\Element\TextRun') {
                    $textRun = $element->getElements();
                    // dd($textRun);
                    foreach ($textRun as $text) {
                        // echo "Text :" . $text->getText() . "<br>";
                        if (strpos($text->getText(), '${') !== false) {
                            // echo "Text: " . ($text->getText()) . "<br>";
                            // dd($text->getText());
                            // $dataVar[] = preg_replace('/\$\{([A-Za-z0-9-_]+)\}/', '',$text->getText());
                            // $dataVar[] = preg_replace('/[^A-Za-z0-9\-\_]/', '',$text->getText());
                            preg_match_all('/\$\{([A-Za-z0-9-_]+)\}/', $text->getText(), $matches);
                            if (isset($matches[1])) {
                                // dd($matches);
                                $variableName = $matches[1]; // Ambil nilai KEPALA_DINAS
                                $dataVar[] = $variableName;
                            }
                        }
                    }
                }
                if (get_class($element) == 'PhpOffice\PhpWord\Element\ListItemRun') {
                    $listItemRun = $element->getElements();
                    foreach ($listItemRun as $text) {
                        // echo "Text :" . $text->getText() . "<br>";
                        if (strpos($text->getText(), '${') !== false) {
                            // echo "Text: " . ($text->getText()) . "<br>";
                            // $dataVar[] = preg_replace('/\$\{([A-Za-z0-9-_]+)\}/', '',$text->getText());
                            // $dataVar[] = preg_replace('/[^A-Za-z0-9\-\_]/', '',$text->getText());
                            preg_match_all('/\$\{([A-Za-z0-9-_]+)\}/', $text->getText(), $matches);
                            if (isset($matches[1])) {
                                // dd($matches);
                                $variableName = $matches[1]; // Ambil nilai KEPALA_DINAS
                                $dataVar[] = $variableName;
                            }
                        }
                    }
                }
                if (get_class($element) == 'PhpOffice\PhpWord\Element\Table') {
                    $table = $element->getRows();
                    foreach ($table as $row) {
                        // dd($row);
                        $cell = $row->getCells();
                        foreach ($cell as $item) {
                            // dd($item);
                            $element = $item->getElements();
                            foreach ($element as $el) {
                                // dd($el);
                                if (get_class($el) == 'PhpOffice\PhpWord\Element\TextRun') {
                                    // dd($element);
                                    // echo "Text :" . $el->getText() . "<br>";
                                    if (strpos($el->getText(), '${') !== false) {
                                        // echo "Text: " . preg_replace('/[^A-Za-z0-9\-]/', '', '',$el->getText()) . "<br>";
                                        // $dataVar[] = preg_replace('/\$\{([A-Za-z0-9-_]+)\}/', '',$el->getText());
                                        // $dataVar[] = preg_replace('/[^A-Za-z0-9\-\_]/', '',$el->getText());
                                        preg_match_all('/\$\{([A-Za-z0-9-_]+)\}/', $el->getText(), $matches);
                                            if (isset($matches[1])) {
                                                // dd($matches);
                                                $variableName = $matches[1]; // Ambil nilai KEPALA_DINAS
                                                $dataVar[] = $variableName;
                                            }
                                    }

                                }
                            }
                        }
                    }
                }
            }
        }
        // explode array inside array to single array
        $dataVar = array_merge(...$dataVar);
        $dataVar = array_unique($dataVar);
        $dataVar = array_filter($dataVar);
        // remove index number
        $dataVar = array_values($dataVar);

        // Remove 'ttd' values from the array
        $dataVar = array_filter($dataVar, function($value) {
            return strtolower($value) !== 'ttd';
        });


        // dd($dataVar);
        return $dataVar;
    }

    public function ambilVariabelTemplateDalamTable($lokasiTemplate): array {
        // Open the Docx file
        $dataVar = [];
        $reader = \PhpOffice\PhpWord\IOFactory::createReader('Word2007');
        $phpWord = $reader->load(storage_path('app/public/' . $lokasiTemplate));

        $section = $phpWord->getSections();
        // dd($section);
        foreach ($section as $s) {
            $elements = $s->getElements();
            // dd($elements);
            foreach ($elements as $element) {
                // echo "TextRun: " . (get_class($element) == 'PhpOffice\PhpWord\Element\TextRun' ? 'true' : 'false') . "<br>";
                // get table
                if (get_class($element) == 'PhpOffice\PhpWord\Element\Table') {
                    $table = $element->getRows();
                    foreach ($table as $row) {
                        // dd($row);
                        $cell = $row->getCells();
                        foreach ($cell as $item) {
                            // dd($item);
                            $element = $item->getElements();
                            foreach ($element as $el) {
                                // dd($el);
                                if (get_class($el) == 'PhpOffice\PhpWord\Element\TextRun') {
                                    // dd($element);
                                    // echo "Text :" . $el->getText() . "<br>";
                                    if (strpos($el->getText(), '${') !== false) {
                                        // echo "Text: " . preg_replace('/[^A-Za-z0-9\-]/', '', '',$el->getText()) . "<br>";
                                        // $dataVar[] = preg_replace('/\$\{([A-Za-z0-9-_]+)\}/', '',$el->getText());
                                        // $dataVar[] = preg_replace('/[^A-Za-z0-9\-\_]/', '',$el->getText());
                                        preg_match_all('/\$\{([A-Za-z0-9-_]+)\}/', $el->getText(), $matches);
                                            if (isset($matches[1])) {
                                                // dd($matches);
                                                $variableName = $matches[1]; // Ambil nilai KEPALA_DINAS
                                                $dataVar[] = $variableName;
                                            }
                                    }

                                }
                            }
                        }
                    }
                }
            }
        }
        // explode array inside array to single array
        $dataVar = array_merge(...$dataVar);
        $dataVar = array_unique($dataVar);
        $dataVar = array_filter($dataVar);
        // remove index number
        $dataVar = array_values($dataVar);

        // Remove 'ttd' values from the array
        $dataVar = array_filter($dataVar, function($value) {
            return strtolower($value) !== 'ttd';
        });

        return $dataVar;
    }

    public function checkVariableInElements($search, $lokasiTemplate): bool{
        $result = false;
        // read template file
        $reader = \PhpOffice\PhpWord\IOFactory::createReader('Word2007');
        $phpWord = $reader->load(storage_path('app/public/' . $lokasiTemplate));
        $section = $phpWord->getSections();
        foreach ($section as $s) {
            $elements = $s->getElements();
            // dd($elements);
            foreach ($elements as $element) {
                // echo "TextRun: " . (get_class($element) == 'PhpOffice\PhpWord\Element\TextRun' ? 'true' : 'false') . "<br>";
                if (get_class($element) == 'PhpOffice\PhpWord\Element\TextRun') {
                    $textRun = $element->getElements();
                    foreach ($textRun as $text) {
                        // echo "Text :" . $text->getText() . "<br>";
                        if(get_class($text) == 'PhpOffice\PhpWord\Element\Text'){
                            if (strpos($text->getText(), '${' . $search . '}') !== false) {
                                // echo "Text: " . ($text->getText()) . "<br>";
                                // $dataVar[] = preg_replace('/[^A-Za-z0-9\-_]/', '', $text->getText());
                                $result = true;
                            }
                        }
                    }
                }
                if (get_class($element) == 'PhpOffice\PhpWord\Element\ListItemRun') {
                    $listItemRun = $element->getElements();
                    foreach ($listItemRun as $text) {
                        if(get_class($text) == 'PhpOffice\PhpWord\Element\Text'){
                        // echo "Text :" . $text->getText() . "<br>";
                            if (strpos($text->getText(), '${' . $search . '}') !== false) {
                                // echo "Text: " . ($text->getText()) . "<br>";
                                // $dataVar[] = preg_replace('/[^A-Za-z0-9\-_]/', '', $text->getText());
                                $result = true;
                            }
                        }
                    }
                }
            }
        }
        return $result;
    }

    public function checkVariableInTable($search, $lokasiTemplate): bool{
        $result = false;
        // read template file
        $reader = \PhpOffice\PhpWord\IOFactory::createReader('Word2007');
        $phpWord = $reader->load(storage_path('app/public/' . $lokasiTemplate));

        $section = $phpWord->getSections();
        // dd($section);
        foreach ($section as $s) {
            $elements = $s->getElements();
            // dd($elements);
            foreach ($elements as $table) {
                // echo "TextRun: " . (get_class($table) == 'PhpOffice\PhpWord\Element\TextRun' ? 'true' : 'false') . "<br>";
                // get table
                if (get_class($table) == 'PhpOffice\PhpWord\Element\Table') {
                    $rows = $table->getRows();
                    foreach ($rows as $row) {
                        // dd($row);
                        if (get_class($row) == 'PhpOffice\PhpWord\Element\Row'){
                            $cell = $row->getCells();
                            // dd($cell);
                            foreach ($cell as $item) {
                                if (get_class($item) == 'PhpOffice\PhpWord\Element\Cell'){
                                    // dd($item);
                                    $element = $item->getElements();
                                    foreach ($element as $textRun) {
                                        // dd($textRun);
                                        if (get_class($textRun) == 'PhpOffice\PhpWord\Element\TextRun') {
                                            // dd($textRun);
                                            foreach ($textRun->getElements() as $text) {
                                                // echo "Text :" . $text->getText() . "<br>";
                                                if(get_class($text) == 'PhpOffice\PhpWord\Element\Text'){
                                                    // dd($text);
                                                    if (strpos($text->getText(), '${' . $search . '}') !== false) {
                                                        // echo "Text: " . ($text->getText()) . "<br>";
                                                        // $dataVar[] = preg_replace('/[^A-Za-z0-9\-_]/', '', $text->getText());
                                                        $result = true;
                                                    }
                                                }
                                            }

                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $result;
    }
}