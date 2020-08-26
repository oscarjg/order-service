<?php

namespace App\Controller;

use App\Helper\RequestParametersHelper;
use App\Order\CreateOrderObject;
use App\Order\OrderService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class OrderController
 *
 * @author Oscar Jimenez <oscarjg19.developer@gmail.com>
 * @package App\Controller
 *
 * @Route("/orders")
 */
class OrderController
{
    /**
     * @var OrderService
     */
    protected $orderService;

    /**
     * OrderController constructor.
     *
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param Request $request
     *
     * @Route("/create", name="order_create", methods={"POST"})
     *
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $response = $this->orderService->createOrder(
            new CreateOrderObject(
                RequestParametersHelper::resolveContent($request, 'orderLines', [])
            )
        );

        if ($response->isSuccess()) {
            return new JsonResponse([
                'message' => 'Order created successfully',
                'order'   => [
                    "id" => $response->order->getId() // Serialization should be required here
                ]
            ]);
        }

        return new JsonResponse([
            'message' => $response->errorMessage,
        ], JsonResponse::HTTP_BAD_REQUEST);
    }

    /**
     *
     * @param $orderId
     *
     * @Route("/confirm/{orderId}", name="order_confirm", methods={"POST"})
     *
     * @return JsonResponse
     */
    public function confirmed($orderId)
    {
        $response = $this->orderService->confirmOrder(intval($orderId));

        if ($response->isSuccess()) {
            return new JsonResponse([
                'message' => 'Order has been confirmed successfully',
                'order'   => [
                    "id" => $response->order->getId() // Serialization should be required here
                ]
            ]);
        }

        return new JsonResponse([
            'message' => $response->errorMessage,
        ], JsonResponse::HTTP_BAD_REQUEST);
    }
}
