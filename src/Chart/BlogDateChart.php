<?php

namespace App\Chart;

use App\Repository\BlogRepository;
use App\Settings\ThemeSettings;
use Jbtronics\SettingsBundle\Manager\SettingsManagerInterface;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

readonly class BlogDateChart
{
    public function __construct(public ChartBuilderInterface $chartBuilder, public BlogRepository $blogRepository, public SettingsManagerInterface $settingsManager)
    {
    }

    public function getChart(): Chart
    {
        $date = new \DateTime('now');
        $date->modify('last monday');

        $settings = $this->settingsManager->get(ThemeSettings::class);

        $colors = [
            $settings->yellow,
            $settings->red,
            $settings->blue,
            $settings->green,
            $settings->pink,
            $settings->indigo,
            $settings->brown,
        ];

        $data = [];
        for ($i = 0; $i <= 7; ++$i) {
            $data[$date->format('l')] = 0;
            $date->modify('+1 day');
        }

        $blogs = $this->blogRepository->findAll();
        foreach ($blogs as $blog) {
            ++$data[$blog->getPublishDate()->format('l')];
        }

        $chart = $this->chartBuilder->createChart(Chart::TYPE_BAR);
        $chart->setData([
            'labels' => array_keys($data),
            'datasets' => [
                [
                    'label' => 'Blog posts per day',
                    'backgroundColor' => $colors,
                    'data' => $data,
                ],
            ],
        ]);

        return $chart;
    }
}
