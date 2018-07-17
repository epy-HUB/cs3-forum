<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JD\Cloudder\Facades\Cloudder;

use App\User;

class UserAvatarController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function store(Request $request, User $user){
        $this->validate(request(), [
            'avatar' => ['required', 'image']
        ]);

        $image_name = $request->file('avatar')->getRealPath();;

        Cloudder::upload($image_name, null);

        list($width, $height) = getimagesize($image_name);

        $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
 

        auth()->user()->update([
            'avatar_path' => $image_url
        ]);

        return response(['uploaded'], 204);
        // return back();
    }

   
}
