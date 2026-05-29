<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use App\Services\SeoService;
use Illuminate\View\View;

class StaticPageController extends Controller
{
    public function __construct(
        protected SeoService $seoService
    ) {}

    /**
     * Display the About page.
     */
    public function about(): View
    {
        $page = StaticPage::where('slug', 'tentang-kami')->firstOrFail();
        $seo = $this->seoService->generateForPage($page->title, 'Tentang ' . config('news_portal.site.name'));

        return view('public.static.about', compact('page', 'seo'));
    }

    /**
     * Display the Redaksi page.
     */
    public function redaksi(): View
    {
        $teams = \App\Models\EditorialTeam::orderBy('order_column')->get();

        // Group by roles in the exact order requested
        $roleOrder = [
            'Pemimpin Redaksi / Penanggung Jawab',
            'Wakil Pemimpin Redaksi',
            'Redaktur Pelaksana',
            'Tim Broadcaster & Gate Keeper',
            'Jurnalis / Reporter Lapangan',
            'Spesialis Media Sosial / Content Creator',
            'Tim Produksi Audio Visual & Desain'
        ];

        // Sort the grouped teams according to $roleOrder
        $groupedTeams = $teams->groupBy('role')->sortBy(function ($item, $key) use ($roleOrder) {
            $index = array_search($key, $roleOrder);
            return $index === false ? 999 : $index;
        });

        $seo = $this->seoService->generateForPage('Susunan Redaksi', 'Susunan redaksi ' . config('news_portal.site.name'));

        return view('public.static.redaksi', compact('groupedTeams', 'seo'));
    }
}
