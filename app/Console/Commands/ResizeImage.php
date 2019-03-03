<?php

namespace App\Console\Commands;

use App\Console\Traits\UsesDatedConsoleOutput;
use App\Models\Image;
use App\Models\Task;
use Exception;
use File;
use Illuminate\Console\Command;
use Intervention\Image\Facades\Image as InterventionImage;
use Log;

class ResizeImage extends Command {
    use UsesDatedConsoleOutput;

    protected $signature = 'divelog:resize_image
        {id : the task id}';

    protected $description = 'Stores various image sizes after upload';

    public function handle(): void {
        $task = Task::find($this->argument('id'));

        if (!$task || !isset($task->options['image_id'])) {
            $task->status = Task::STATUS_ABANDONED;
            $task->save();
            $this->line('Image could not be found, task marked as abandoned');

            return;
        }

        $task->status = Task::STATUS_RUNNING;
        $task->tries++;
        $task->save();

        $image = Image::find($task->options['image_id']);
        $this->line("Found image id: $image->id");

        $intervention_image = InterventionImage::make(File::get(storage_path($image->folder . $image->file_name)));

        $small_folder = $image->folder . 'small/';
        $medium_folder = $image->folder . 'medium/';
        $large_folder = $image->folder . 'large/';
        $xl_folder = $image->folder . 'xl/';

        try {
            if (!File::exists(storage_path($xl_folder))) {
                File::makeDirectory(storage_path($xl_folder));
            }

            if ($image->has_high_res) {
                $xl_image = $intervention_image;
                $xl_image->resize('3840', null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $xl_image->save(storage_path($xl_folder . $image->file_name));
                unset($xl_image);
            }

            if (!File::exists(storage_path($large_folder))) {
                File::makeDirectory(storage_path($large_folder));
            }

            $large_image = $intervention_image;
            $large_image->resize('1920', null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $large_image->save(storage_path($large_folder . $image->file_name));
            unset($large_image);

            if (!File::exists(storage_path($medium_folder))) {
                File::makeDirectory(storage_path($medium_folder));
            }

            $medium_image = $intervention_image;
            $medium_image->resize('1080', null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $medium_image->save(storage_path($medium_folder . $image->file_name));
            unset($medium_image);

            if (!File::exists(storage_path($small_folder))) {
                File::makeDirectory(storage_path($small_folder));
            }

            $small_image = $intervention_image;
            $small_image->resize('600', null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $small_image->save(storage_path($small_folder . $image->file_name));
            unset($small_image);

            $image->has_sizes = 1;
            $image->save();

            $task->status = Task::STATUS_COMPLETE;
        } catch (Exception $exception) {
            Log::error($exception);
            $task->status = Task::STATUS_FAILED;
        }

        $task->save();
    }
}
