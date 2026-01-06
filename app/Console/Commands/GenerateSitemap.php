<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate the sitemap.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $sitemap = Sitemap::create();

        $pages = [
            ['url' => route('home'), 'priority' => 1.0],
            ['url' => route('features'), 'priority' => 0.8],
            ['url' => route('pricing'), 'priority' => 0.8],
        ];

        foreach ($pages as $page) {
            $sitemap->add(
                Url::create($page['url'])
                    ->setPriority($page['priority'])
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            );
        }
        // Add dynamic pages
        // $results = \App\Models\Blog::all();
        // foreach ($results as $result) {
        //     $sitemap->add(Url::create(route('result', $result->uuid))->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));
        // }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully.');
    }
}
