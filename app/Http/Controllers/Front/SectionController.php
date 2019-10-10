<?php

namespace App\Http\Controllers\Front;

use App\Blog\Sections\Repositories\Interfaces\SectionRepositoryInterface;
use App\Blog\Sections\Repositories\SectionRepository;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    /**
     * @var SectionRepositoryInterface
     */
    private $SectionRepositoryInterface;

    /**
     * SectionController constructor.
     *
     * @param SectionRepositoryInterface $sectionRepository
     */
    public function __construct(SectionRepositoryInterface $sectionRepository)
    {
        $this->sectionRepo = $sectionRepository;
    }

    /**
     * Find the section via the slug
     *
     * @param string $slug
     * @return \App\Blog\Sections\Section
     */
    public function getSection(string $slug)
    {
        $section = $this->sectionRepo->findSectionBySlug(['slug' => $slug]);

        $repo = new SectionRepository($section);

        $articles = $repo->findArticles()->where('status', 1)->all();

        return view('frontend.sections.section', [
            'section' => $section,
            'articles' => $repo->paginateArrayResults($articles, 20)
        ]);
    }
}
