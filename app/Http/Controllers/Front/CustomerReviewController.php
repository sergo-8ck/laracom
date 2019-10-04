<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Blog\Reviews\Requests\CreateReviewRequest;
use App\Blog\Reviews\Requests\UpdateReviewRequest;
use App\Blog\Reviews\Repositories\ReviewRepository;
use App\Shop\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Blog\Reviews\Repositories\Interfaces\ReviewRepositoryInterface;
use App\Shop\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use App\Shop\Provinces\Repositories\Interfaces\ProvinceRepositoryInterface;
use Illuminate\Http\Request;

class CustomerReviewController extends Controller
{
    /**
     * @var ReviewRepositoryInterface
     */
    private $reviewRepo;

    /**
     * @var CountryRepositoryInterface
     */
    private $countryRepo;

    /**
     * @var CityRepositoryInterface
     */
    private $cityRepo;

    /**
     * @var ProvinceRepositoryInterface
     */
    private $provinceRepo;


    /**
     * @param ReviewRepositoryInterface  $reviewRepository
     * @param CountryRepositoryInterface  $countryRepository
     * @param CityRepositoryInterface     $cityRepository
     * @param ProvinceRepositoryInterface $provinceRepository
     */
    public function __construct(
        ReviewRepositoryInterface $reviewRepository,
        CountryRepositoryInterface $countryRepository,
        CityRepositoryInterface $cityRepository,
        ProvinceRepositoryInterface $provinceRepository
    ) {
        $this->reviewRepo = $reviewRepository;
        $this->countryRepo = $countryRepository;
        $this->provinceRepo = $provinceRepository;
        $this->cityRepo = $cityRepository;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {

        return redirect()->route('accounts', ['tab' => 'review']);
    }

    /**
     * @param  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $customer = auth()->user();

        return view('front.customers.reviews.create', [
            'customer' => $customer,
            'countries' => $this->countryRepo->listCountries(),
            'cities' => $this->cityRepo->listCities(),
            'provinces' => $this->provinceRepo->listProvinces()
        ]);
    }

    /**
     * @param CreateReviewRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateReviewRequest $request)
    {
        $request['customer_id'] = auth()->user()->id;

        $review = $this->reviewRepo->createReview($request->except('_token', '_method'));

        $reviewRepo = new ReviewRepository($review);

        if ($request->hasFile('image')) {
            $reviewRepo->saveReviewImages(collect($request->file('image')));
        }

        return redirect()->route('accounts', ['tab' => 'review'])
                         ->with('message', 'Review creation successful');
    }

    /**
     * @param $reviewId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($customerId, $reviewId)
    {
        $review = $this->reviewRepo->findCustomerReviewById($reviewId, auth()->user());

        return view('front.customers.reviews.edit', [
            'customer' => auth()->user(),
            'review' => $review,
            'images' => $review->images()->get(['src']),
            'cities' => $this->cityRepo->listCities(),
            'provinces' => $this->provinceRepo->listProvinces()
        ]);
    }

    /**
     * @param UpdateReviewRequest $request
     * @param                     $customerId
     * @param                     $reviewId
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Blog\Reviews\Exceptions\ReviewNotFoundException
     */
    public function update(UpdateReviewRequest $request, $customerId, $reviewId)
    {
        $review = $this->reviewRepo->findCustomerReviewById($reviewId, auth()->user());

//        $request = $request->except('_token', '_method');
        $data = $request->except(
            '_token',
            '_method',
            'image'
        );
        $data['customer_id'] = auth()->user()->id;

        $reviewRepo = new ReviewRepository($review);

        if ($request->hasFile('image')) {
            $reviewRepo->saveReviewImages(collect($request->file('image')));
        }

        $reviewRepo = new ReviewRepository($review);
        $reviewRepo->updateReview($data);

        return redirect()->route('accounts', ['tab' => 'review'])
                         ->with('message', 'Review update successful');
    }

    /**
     * @param $reviewId
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($customerId, $reviewId)
    {
        $review = $this->reviewRepo->findCustomerReviewById($reviewId, auth()->user());

        $articleRepo = new ReviewRepository($review);
        $articleRepo->deleteReview();

        return redirect()->route('accounts', ['tab' => 'reviews'])
                         ->with('message', 'Review delete successful');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeImage(Request $request)
    {
        $this->reviewRepo->deleteFile($request->only('section', 'field'), 'sections');
        request()->session()->flash('message', 'Image delete successful');
        return redirect()->route('admin.review.edit', $request->input('review'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeThumbnail(Request $request)
    {
        $this->reviewRepo->deleteThumb($request->input('src'));
        return redirect()->back()->with('message', 'Image delete successful');
    }
}
