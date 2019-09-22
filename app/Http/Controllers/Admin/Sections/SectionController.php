<?php

namespace App\Http\Controllers\Admin\Sections;

use App\Blog\Sections\Repositories\SectionRepository;
use App\Blog\Sections\Repositories\Interfaces\SectionRepositoryInterface;
use App\Blog\Sections\Requests\UpdateSectionRequest;
use App\Http\Controllers\Controller;
use App\Blog\Sections\Requests\CreateSectionRequest;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * @var SectionRepositoryInterface
     */
    private $sectionRepo;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->sectionRepo->rootSections('created_at', 'desc');

        return view('admin.sections.list', [
            'sections' => $this->sectionRepo->paginateArrayResults($list->all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sections.create', [
            'sections' => $this->sectionRepo->listSections('name', 'asc')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSectionRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSectionRequest $request)
    {
        $this->sectionRepo->createSection($request->except('_token', '_method'));

        return redirect()->route('admin.sections.index')->with('message', 'Section created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = $this->sectionRepo->findSectionById($id);

        $cat = new SectionRepository($section);

        return view('admin.sections.show', [
            'section' => $section,
            'sections' => $section->children,
            'articles' => $cat->findArticles()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.sections.edit', [
            'sections' => $this->sectionRepo->listSections('name', 'asc', $id),
            'section' => $this->sectionRepo->findSectionById($id)
        ]);
    }


    /**
     * @param UpdateSectionRequest $request
     * @param                      $id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Blog\Sections\Exceptions\SectionNotFoundException
     */
    public function update(UpdateSectionRequest $request, $id)
    {
        $section = $this->sectionRepo->findSectionById($id);

        $update = new SectionRepository($section);
        $update->updateSection($request->except('_token', '_method'));

        $request->session()->flash('message', 'Update successful');
        return redirect()->route('admin.sections.edit', $id);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        $section = $this->sectionRepo->findSectionById($id);
        $section->articles()->sync([]);
        $section->delete();

        request()->session()->flash('message', 'Delete successful');
        return redirect()->route('admin.sections.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeImage(Request $request)
    {
        $this->sectionRepo->deleteFile($request->only('section', 'field'), 'sections');
        request()->session()->flash('message', 'Image delete successful');
        return redirect()->route('admin.sections.edit', $request->input('section'));
    }
}
