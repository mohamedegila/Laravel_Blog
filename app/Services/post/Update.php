<?php



namespace App\Services\post;

use App\Models\Admin;
use App\Repository\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class Update
{
    private $postRepository;
    private $helper;
    private $create;

    public function __construct(PostRepository $PostRepository)
    {
        $this->postRepository = $PostRepository;
        $this->helper = new HelperMethods();
        $this->create = new Create($this->postRepository);
    }

    public function execute(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'details'=>'required',
            'category'=>'required'
            ]);
            
        $post = $this->postRepository->getById($id);

        if ($post->full_img !== "na") {
            $this->helper->destroyImage($post->full_img, '/imgs/full');
        }
        
        if ($post->thumb !== "na") {
            $this->helper->destroyImage($post->thumb, '/imgs/thumb');
        }

        

        $reThumbImage = $this->helper->saveThumbImage($request);
        $reFullImage  = $this->helper->saveFullImage($request);

        $data = ['cat_id'=>$request->category,
                 'title'=>$request->title,
                 'thumb'=>$reThumbImage,
                 'full_img'=>$reFullImage,
                 'details'=>$request->details,
                 'tags'=>$request->tags
                ];
        $this->postRepository->update($id, $data);
    }
}
