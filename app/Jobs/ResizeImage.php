<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\ImageManager;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $file;
    /**
     * @var array
     */
    private $formats;

    public function __construct(string $file, array $formats)
    {
        $this->file = $file;
        $this->formats = $formats;
    }

    public function handle()
    {
        $manager = new ImageManager(['driver' => 'gd']);
        if (file_exists($this->file)) {
            foreach ($this->formats as $format) {
                $manager->make($this->file)
                    ->fit($format, $format)
                    ->rotate(45)
                    ->save(public_path('uploads') . '/' . pathinfo($this->file, PATHINFO_FILENAME) . "_{$format}x{$format}." . pathinfo($this->file, PATHINFO_EXTENSION));
            }
        }
    }
}
