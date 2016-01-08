<?php

namespace HttpMessagesRestMiddleware\Middleware;

use HttpMessagesRestMiddleware\Services\ConfigService;
use HttpMessagesRestMiddleware\Services\RequestService;
use HttpMessagesRestMiddleware\Services\ResponseService;
use HttpMessagesRestMiddleware\Services\RestService;
use HttpMessages\Http\Request;
use HttpMessages\Http\Response;
use HttpMessages\Exceptions\HttpMessagesException;

use HttpMessagesRestMiddleware\Http\RestRequest;

class RestMiddleware
{
    /**
     * Config Service
     *
     * @var HttpMessagesRestMiddleware\Services\ConfigService
     */
    protected $config_service;

    /**
     * Request Service
     *
     * @var HttpMessagesRestMiddleware\Services\RequestService
     */
    protected $request_service;

    /**
     * Response Service
     *
     * @var HttpMessagesRestMiddleware\Services\ResponseService
     */
    protected $response_service;

    /**
     * Rest Service
     *
     * @var HttpMessagesRestMiddleware\Services\RestService
     */
    protected $rest_service;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->config_service   = new ConfigService;
        $this->request_service  = new RequestService;
        $this->response_service = new ResponseService;
        $this->rest_service     = new RestService;
    }

    /**
     * Handle
     *
     * @return void
     */
    public function __invoke(Request $request, Response $response, callable $next)
    {
        $request = $this->request_service->getRequest($request);
        $response = $this->response_service->getResponse($response);

        $action = $this->getAction($request->getMethod(), $request->getAttribute('elementType'), $request->getAttribute('elementId'));

        $response = $this->$action($request, $response);

        $response = $response->withCriteria($request->getCriteria());

        return $response;
    }

    /**
     * Get Action
     *
     * @param string  $method       Method
     * @param string  $element_type Element Type
     * @param boolean $element_id   Element Id
     *
     * @return string Action
     */
    private function getAction($method, $element_type, $element_id = null)
    {
        if ($method === 'GET' && !$element_id) {
            return 'actionIndex';
        }

        if ($method === 'GET' && $element_id) {
            return 'actionShow';
        }

        if ($method === 'POST' && !$element_id) {
            return 'actionStore';
        }

        if (in_array($method, ['PUT', 'PATCH']) && $element_id) {
            return 'actionUpdate';
        }

        if ($method === 'DELETE' && $element_id) {
            return 'actionDelete';
        }

        $exception = new HttpMessagesException();
        $exception
            ->setStatus(405)
            ->setMessage(sprintf('`%s` method not allowed for resource `%s`.', $method, $element_type));

        throw $exception;
    }

    /**
     * Action Show
     *
     * @param array $variables Variables
     *
     * @return Response Response
     */
    private function actionIndex(Request $request, Response $response)
    {
        $elements = $this->rest_service->getElements($request);

        return $response->withCollection($elements);
    }

    /**
     * Action Show
     *
     * @param array $variables Variables
     *
     * @return Response Response
     */
    private function actionShow(Request $request, Response $response)
    {
        $element = $this->rest_service->getElement($request);

        return $response->withItem($element);
    }

    /**
     * Action Store
     *
     * @param array $variables Variables
     *
     * @return Response Response
     */
    private function actionStore(Request $request, Response $response)
    {
        $element = $this->rest_service->saveElement($request);

        return $response
            ->withCreated()
            ->withItem($element);
    }

    /**
     * Action Update
     *
     * @param array $variables Variables
     *
     * @return Response Response
     */
    private function actionUpdate(Request $request, Response $response)
    {
        $element = $this->rest_service->saveElement($request);

        return $response
            ->withStatus(200, 'Element updated successfully.')
            ->withItem($element);
    }

    /**
     * Action Delete
     *
     * @param array $variables Variables
     *
     * @return Response Response
     */
    private function actionDelete(Request $request, Response $response)
    {
        $this->rest_service->deleteElement($request);

        return $response->withStatus(204, 'Element deleted successfully.');
    }
}
