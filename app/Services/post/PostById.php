<?php



namespace App\Services\post;

use App\Repository\PostRepository;

class PostById
{
    private $postRepository;

    public function __construct(PostRepository $PostRepository)
    {
        $this->postRepository = $PostRepository;
    }

    public function execute($id)
    {
        return $this->postRepository->getById($id);
    }
}
