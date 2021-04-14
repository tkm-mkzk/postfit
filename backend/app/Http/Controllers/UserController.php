<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\User\EditRequest;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function show($id)
    {
        $user = User::find($id);

        $blogs = $user->blogs->sortByDesc('created_at');

        return view('user.show', [
            'user' => $user,
            'blogs' => $blogs,
        ]);
    }

    public function editForm()
    {
        return view('user.edit')
            ->with('user', Auth::user());
    }

    public function editProfile(EditRequest $request)
    {
        $user = Auth::user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->has('avatar')) {
            $fileName = $this->saveAvatar($request->file('avatar'));
            $user->avatar_file_name = $fileName;
        }

        $user->save();

        return redirect()->back()
            ->with('status', 'プロフィールを変更しました。');
    }

    private function saveAvatar(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->fit(200, 200)->save($tempPath);

        $filePath = Storage::disk('public')
            ->putFile('avatars', new File($tempPath));

        return basename($filePath);
    }

    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta   = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }


    public function likes($id)
    {
        $user = User::where('id', $id)->first();

        $blogs = $user->likes->sortByDesc('created_at');

        return view('user.likes', [
            'user' => $user,
            'blogs' => $blogs,
        ]);
    }

    public function followings($id)
    {
        $user = User::where('id', $id)->first();

        $followings = $user->followings->sortByDesc('created_at');

        return view('user.followings', [
            'user' => $user,
            'followings' => $followings,
        ]);
    }

    public function followers($id)
    {
        $user = User::where('id', $id)->first();

        $followers = $user->followers->sortByDesc('created_at');

        return view('user.followers', [
            'user' => $user,
            'followers' => $followers,
        ]);
    }

    public function follow(Request $request, $id)
    {
        $user = User::find($id);

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return ['id' => $id];
    }

    public function unfollow(Request $request, $id)
    {
        $user = User::find($id);

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return ['id' => $id];
    }
}
