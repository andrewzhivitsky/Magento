<?php

namespace Alevel\MyModule\Block;

use Alevel\MyModule\Api\PostRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Post
 * @package Alevel\MyModule\Block
 */
class Post extends Template
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * Post constructor.
     *
     * @param Context                 $context
     * @param PostRepositoryInterface $postRepository
     * @param SearchCriteriaBuilder   $searchCriteriaBuilder
     * @param array                   $data
     */
    public function __construct(
        Context $context,
        PostRepositoryInterface $postRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->postRepository = $postRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * <pre>
     * - ["from" => $fromValue, "to" => $toValue]
     * - ["eq" => $equalValue]
     * - ["neq" => $notEqualValue]
     * - ["like" => $likeValue]
     * - ["in" => [$inValues]]
     * - ["nin" => [$notInValues]]
     * - ["notnull" => $valueIsNotNull]
     * - ["null" => $valueIsNull]
     * - ["moreq" => $moreOrEqualValue]
     * - ["gt" => $greaterValue]
     * - ["lt" => $lessValue]
     * - ["gteq" => $greaterOrEqualValue]
     * - ["lteq" => $lessOrEqualValue]
     * - ["finset" => $valueInSet]
     * </pre>
     *
     * @return \Alevel\MyModule\Api\Data\PostSearchResultsInterface
     */
    public function getPost()
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('enabled', true, 'eq')
            ->create();

        $searchResult = $this->postRepository->getList($searchCriteria);

        return $searchResult;
    }
}