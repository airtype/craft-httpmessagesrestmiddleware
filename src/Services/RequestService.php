<?php

namespace HttpMessagesRestMiddleware\Services;

use HttpMessages\Http\CraftRequest as Request;
use HttpMessagesRestMiddleware\Http\RestRequest;

class RequestService
{
    /**
     * Get Request
     *
     * @param Request $request Request
     *
     * @return RestRequest RestRequest
     */
    public function getRequest(Request $request)
    {
        $request = new RestRequest($request);

        $request = $this->withCriteria($request);

        return $request;
    }

    /**
     * With Criteria
     *
     * @param Request $request Request
     *
     * @return RestRequest RestRequest
     */
    private function withCriteria(Request $request)
    {
        $element_type = $request->getAttribute('elementType');
        $element_id   = $request->getAttribute('elementId');
        $attributes   = array_merge($request->getQueryParams(), $request->getAttributes());

        $criteria = \Craft\craft()->elements->getCriteria($element_type, $attributes);

        $pagination_parameter = \Craft\craft()->config->get('paginationParameter', 'restfulApi');

        if (isset($criteria->$pagination_parameter)) {
            $criteria->offset = ($criteria->$pagination_parameter - 1) * $criteria->limit;
            unset($criteria->$pagination_parameter);
        }

        if ($element_id) {
            $criteria->archived = null;
            $criteria->fixedOrder = null;
            $criteria->limit = 1;
            $criteria->localeEnabled = false;
            $criteria->offset = 0;
            $criteria->order = null;
            $criteria->status = null;
            $criteria->editable = null;

            if (is_numeric($element_id)) {
                $criteria->id = $element_id;
            } else {
                $criteria->slug = $element_id;
            }
        }

        return $request->withCriteria($criteria);
    }

}
