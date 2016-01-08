<?php

namespace HttpMessagesRestMiddleware\Http;

use HttpMessages\Http\CraftRequest as Request;
use Craft\ElementCriteriaModel;

class RestRequest extends Request
{
    /**
     * Criteria
     *
     * @var Craft\ElementCriteriaModel
     */
    protected $criteria;

    /**
     * Constructor
     *
     * @param Request $request Request
     */
    public function __construct(Request $request)
    {
        foreach (get_object_vars($request) as $property => $value) {
            $this->$property = $value;
        }
    }

    /**
     * Get Criteria
     *
     * @return ElementCriteriaModel Criteria
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * With Criteria
     *
     * @param ElementCriteriaModel|null $criteria Criteria
     *
     * @return Rest Request Rest Request
     */
    public function withCriteria(ElementCriteriaModel $criteria = null)
    {
        $new = clone $this;

        $new->criteria = $criteria;

        return $new;
    }
}
