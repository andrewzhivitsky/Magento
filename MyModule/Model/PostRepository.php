<?php
namespace Alevel\MyModule\Model;

use Alevel\MyModule\Api\Data\PostInterface;
use Alevel\MyModule\Api\Data\PostSearchResultsInterface;
use Alevel\MyModule\Api\PostRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Alevel\MyModule\Api\Data\PostSearchResultsInterfaceFactory;
use Alevel\MyModule\Model\ResourceModel\Post\CollectionFactory;
use Alevel\MyModule\Model\PostFactory;
use Alevel\MyModule\Model\ResourceModel\Post as ResourceModel;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class PostRepository.
 *
 * @package Alevel\MyModule\Model
 */
class PostRepository implements PostRepositoryInterface
{
    /**
     * @var ResourceModel
     */
    protected $resource;

    /**
     * @var \Alevel\MyModule\Model\PostFactory
     */
    protected $postFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var PostSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * PostRepository constructor.
     *
     * @param ResourceModel                      $resource
     * @param \Alevel\MyModule\Model\PostFactory $postFactory
     * @param CollectionProcessorInterface       $collectionProcessor
     * @param CollectionFactory                  $collectionFactory
     * @param PostSearchResultsInterfaceFactory  $postSearchResultsInterfaceFactory
     */
    public function __construct(
        ResourceModel $resource,
        PostFactory $postFactory,
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $collectionFactory,
        PostSearchResultsInterfaceFactory $postSearchResultsInterfaceFactory
    ) {
        $this->resource = $resource;
        $this->postFactory = $postFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $postSearchResultsInterfaceFactory;
    }

    /**
     * @param int $id
     *
     * @return PostInterface|void
     * @throws NoSuchEntityException
     */
    public function getById(int $id)
    {
        $post = $this->postFactory->create();
        $this->resource->load($post, $id);

        if (!$post->getId()) {
            throw new NoSuchEntityException(__('Post with id "%1" does not exist.', $id));
        }
    }

    public function deleteById(int $id)
    {
        $this->delete($this->getById($id));
    }

    /**
     * @param PostInterface $post
     *
     * @throws CouldNotSaveException
     */
    public function save(PostInterface $post): void
    {
        try {
            $this->resource->save($post);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return PostSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());

        return $searchResult;
    }

    /**
     * @param PostInterface $post
     *
     * @return $this
     */
    public function delete(PostInterface $post)
    {
        try {
            $this->resource->delete($post);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return $this;
    }
}
