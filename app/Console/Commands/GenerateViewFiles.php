<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateViewFiles extends Command
{
    // The name and signature of the console command.
    protected $signature = 'make:views {name}';

    // The console command description.
    protected $description = 'Generate index, edit, and show view files';

    // Execute the console command.
    public function handle()
    {
        $name = $this->argument('name');
    

        // Set the directory path where the views will be created
        $viewPath = resource_path("views/{$name}");

        // Create the views directory if it doesn't exist
        if (!File::exists($viewPath)) {
            File::makeDirectory($viewPath, 0755, true);
        }

        // Define the view files to create
        $views = [
            'index.blade.php',
            'edit.blade.php',
            'show.blade.php',
        ];

        // Create each view file
        foreach ($views as $view) {
            $filePath = "{$viewPath}/{$view}";

            // Add default content to each file if needed
            switch ($view) {
                case 'index.blade.php':
                    $content = "<!-- Index View for {$name} -->\n<h1>Index of {$name}</h1>";
                    break;

                case 'edit.blade.php':
                    $content = "<!-- Edit View for {$name} -->\n<h1>Edit {$name}</h1>";
                    break;

                case 'show.blade.php':
                    $content = "<!-- Show View for {$name} -->\n<h1>Show {$name}</h1>";
                    break;

                default:
                    $content = '';
                    break;
            }

            // Create the file with the defined content
            File::put($filePath, $content);
            $this->info("Generating views for: {$name}");
        }

        $this->info('View files generated successfully.');
    }
}