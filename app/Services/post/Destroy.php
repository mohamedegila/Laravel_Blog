<?php



namespace App\Services\post;

use App\Repository\PostRepository;

class Destroy
{
    private $postRepository;
    private $helper;

    public function __construct(PostRepository $PostRepository)
    {
        $this->postRepository = $PostRepository;
        $this->helper = new HelperMethods();
    }

    public function execute($id)
    {
        $post = $this->postRepository->getById($id);
        
        
        
        if ($post->full_img !== "na") {
            $this->helper->destroyImage($post->full_img, '/imgs/full');
        }
        
        if ($post->thumb !== "na") {
            $this->helper->destroyImage($post->thumb, '/imgs/thumb');
        }
        
        return $this->postRepository->destroy($id);
    }
}
