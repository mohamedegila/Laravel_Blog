<?php



namespace App\Services\post;

use App\Repository\PostRepository;

class AllPosts
{
    private $postRepository;

    public function __construct(PostRepository $PostRepository)
    {
        $this->postRepository = $PostRepository;
    }

    public function execute()
    {
        return $this->postRepository->all();
    }
}
