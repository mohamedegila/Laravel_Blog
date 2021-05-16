<?php



namespace App\Services\post;

use Illuminate\Http\Request;

class HelperMethods
{
    public function destroyImage($fileName, $imagePath)
    {
        $path = public_path($imagePath).'/'.$fileName;
        unlink($path);
    }

    private function saveImage(Request $request, $fileName, $imagePath)
    {
        $image1=$request->file($fileName);
        $imageName=time().'.'.$image1->getClientOriginalExtension();
        $dest1=public_path($imagePath);
        $image1->move($dest1, $imageName);

        return $imageName;
    }

    public function saveThumbImage(Request $request)
    {
        if ($request->hasFile('post_thumb')) {
            $reThumbImage = $this->saveImage($request, 'post_thumb', '/imgs/thumb');
        } else {
            $reThumbImage=$request->post_thumb??'na';
        }

        return $reThumbImage;
    }

    public function saveFullImage(Request $request)
    {
        // Post Full Image
        if ($request->hasFile('post_image')) {
            $reFullImage = $this->saveImage($request, 'post_image', '/imgs/full');
        } else {
            $reFullImage=$request->post_thumb??'na';
        }

        return $reFullImage;
    }
}
