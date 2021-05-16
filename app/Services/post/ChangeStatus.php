<?php



namespace App\Services\post;

use App\Repository\PostRepository;

class ChangeStatus
{
    private $postRepository;

    public function __construct(PostRepository $PostRepository)
    {
        $this->postRepository = $PostRepository;
    }

    public function execute($id, $status)
    {
        $post = $this->postRepository->getById($id);

        $post->status=$status;
        $post->save();
    }
}
