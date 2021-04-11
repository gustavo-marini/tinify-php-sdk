<?php

    namespace Secco2112\Tinify\Traits;

    use finfo;
    use Mimey\MimeTypes;

    trait DownloadHelper {

        private function downloadHeaders() {
            $now = gmdate("D, d M Y H:i:s");
            header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
            header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
            header("Last-Modified: {$now} GMT");
            header("Content-Type: application/force-download");
            header("Content-Type: application/download");
            header("Content-Transfer-Encoding: binary");
        }
        
        protected function downloadFromUrl(string $url, string $filename, string $mimetype) {
            $mimes = new MimeTypes;
            
            $contents = file_get_contents($url);

            if(empty($filename)) {
                $filename = basename($url);
            }

            $extension = $mimes->getExtension($mimetype);

            $this->downloadHeaders();
            header("Content-Type: " . $mimetype);
            header("Content-Disposition: attachment;filename={$filename}.{$extension}");
            echo $contents;
            exit;
        }

        protected function downloadFromBlob(string $contents, string $filename) {
            $mimes = new MimeTypes;

            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimetype = $finfo->buffer($contents);
            $extension = $mimes->getExtension($mimetype);

            $this->downloadHeaders();
            header("Content-Type: " . $mimetype);
            header("Content-Disposition: attachment;filename={$filename}.{$extension}");
            echo $contents;
            exit;
        }

    }