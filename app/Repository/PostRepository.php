<?php
namespace  App\Repository;

use App\Models\Post;
use App\Repository\BaseRepository;

class PostRepository extends BaseRepository
{
    public function __construct(Post $post)
    {
        parent::__construct($post);
    }

    public function count():int
    {
        return $this->model->count();
    }

    public function getActivePostsOnly()
    {
        return $this->model->where('status', 1)->orderBy('id', 'desc')->get();
    }
    public function active_posts():int
    {
        return $this->model->all()->where('status', 1)->count();
    }

    public function inactive_posts():int
    {
        return $this->model->all()->where('status', 0)->count();
    }
}
