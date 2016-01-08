<?php

namespace HttpMessagesRestMiddleware\Services;

use HttpMessagesRestMiddleware\Services\ElementService;
use HttpMessagesRestMiddleware\Http\RestRequest as Request;

class RestService
{
    /**
     * Element Service
     *
     * @var HttpMessagesRestMiddleware\Services\ElementService
     */
    protected $element_service;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->element_service = new ElementService;
    }


    /**
     * Get Elements
     *
     * @param Request $request Request
     *
     * @return array Elements
     */
    public function getElements(Request $request)
    {
        return $this->element_service->getElements($request->getCriteria());
    }

    /**
     * Get Element
     *
     * @param Request $request Request
     *
     * @return BaseElementModel Element
     */
    public function getElement(Request $request)
    {
        return $this->element_service->getElement($request);
    }

    /**
     * Save Element
     *
     * @param Request $request Request
     *
     * @return BaseElementModel Element
     */
    public function saveElement(Request $request)
    {
        $element = $this->element_service->getElement($request);

        $populated_element = $this->element_service->populateElement($element, $request);

        $validator = craft()->restfulApi_config->getValidator($populated_element->getElementType());

        $this->element_service->validateElement($populated_element, $validator);

        return $this->element_service->saveElement($populated_element, $request);
    }

    /**
     * Delete Element
     *
     * @param Request $request Request
     *
     * @return void
     */
    public function deleteElement(Request $request)
    {
        $this->element_service->deleteElement($request);
    }

}
