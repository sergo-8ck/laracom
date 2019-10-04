<?php

namespace App\Http\Controllers\Front;

use App\Blog\Reviews\Repositories\Interfaces\ReviewRepositoryInterface;
use App\Shop\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use App\Shop\Customers\Repositories\CustomerRepository;
use App\Shop\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Shop\Orders\Order;
use App\Shop\Orders\Transformers\OrderTransformable;

class AccountsController extends Controller
{
    use OrderTransformable;

    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepo;

    /**
     * @var CourierRepositoryInterface
     */
    private $courierRepo;

    /**
     * @var ReviewRepositoryInterface
     */
    private $reviewRepo;

    /**
     * AccountsController constructor.
     *
     * @param CourierRepositoryInterface $courierRepository
     * @param CustomerRepositoryInterface $customerRepository
     * @param ReviewRepositoryInterface $reviewRepository
     */
    public function __construct(
        CourierRepositoryInterface $courierRepository,
        CustomerRepositoryInterface $customerRepository,
        ReviewRepositoryInterface $reviewRepository
    ) {
        $this->customerRepo = $customerRepository;
        $this->courierRepo = $courierRepository;
        $this->reviewRepo = $reviewRepository;
    }

    public function index()
    {
        $customer = $this->customerRepo->findCustomerById(auth()->user()->id);

        $customerRepo = new CustomerRepository($customer);
        $orders = $customerRepo->findOrders(['*'], 'created_at');

        $orders->transform(function (Order $order) {
            return $this->transformOrder($order);
        });

        $orders->load('products');

        $addresses = $customerRepo->findAddresses();

        $reviews = $customerRepo->getReviews();

        return view('front.accounts', [
            'customer' => $customer,
            'orders' => $this->customerRepo->paginateArrayResults($orders->toArray(), 15),
            'addresses' => $addresses,
            'reviews' => $reviews,
        ]);
    }
}
