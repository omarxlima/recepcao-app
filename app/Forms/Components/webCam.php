<?php

namespace App\Forms\Components;

use Filament\Forms\Components\FileUpload;

class webCam extends FileUpload
{
    protected string $view = 'forms.components.web-can';
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->afterStateHydrated(function (Webcam $component, $state) {
            $component->statePath('webcam_image');
        });

        $this->saveUploadedFileUsing(function ($file) {
            return $file->storePublicly('webcam_images', ['disk' => 'public']);
        });

        $this->view('forms.components.web-cam');
    }
}


