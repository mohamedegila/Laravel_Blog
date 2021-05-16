<?php



namespace App\Services\post;

use App\Models\Admin;
use App\Repository\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class Create
{
    private $postRepository;

    public function __construct(PostRepository $PostRepository)
    {
        $this->postRepository = $PostRepository;
        $this->helper = new HelperMethods();
    }

    public function execute(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'details'=>'required',
            'category'=>'required'
        ]);
        
       
        $reThumbImage = $this->helper->saveThumbImage($request);
        $reFullImage  = $this->helper->saveFullImage($request);

        $is_auto = $this->checkPostAutoAcceptOrNot();
        
        $status = $request->user()!=null
                            ?(($is_auto == 1)?1:0):1;
        $data = ['user_id'=>$request->user()!=null?$request->user()->id:1,
                 'cat_id'=>$request->category,
                 'title'=>$request->title,
                 'thumb'=>$reThumbImage,
                 'full_img'=>$reFullImage,
                 'details'=>$request->details,
                 'tags'=>$request->tags,
                 'status'=>$status];
       

        $resultData = $this->postRepository->create($data);
        return $resultData;
    }



    private function checkPostAutoAcceptOrNot()
    {
        return Admin::where('id', 1)
        ->pluck('user_auto')
        ->all()[0];
    }
}
