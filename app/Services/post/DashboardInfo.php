<?php
namespace App\Services\post;

use App\Repository\PostRepository;

class DashboardInfo
{
    private $postRepository;

    public function __construct(PostRepository $PostRepository)
    {
        $this->postRepository = $PostRepository;
    }

    public function execute()
    {
        $posts_count            = $this->postRepository->count();
        $activePosts_count      = $this->postRepository->active_posts();
        $inactivePosts_count    = $this->postRepository->inactive_posts();
        $posts                  =$this->postRepository->getActivePostsOnly();

        $resultData = [
                        'posts'=>$posts,
                        'posts_count'=>$posts_count,
                        'activePosts_count'=>$activePosts_count,
                        'inactivePosts_count'=>$inactivePosts_count
                      ];

        return $resultData;
    }
}
