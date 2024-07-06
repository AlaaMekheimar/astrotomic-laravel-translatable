<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        $post = new Post();

        $post->translateOrNew('en')->title = 'English Title';
        $post->translateOrNew('en')->content = 'English Content';

        $post->translateOrNew('ar')->title = 'عنوان باللغه العربية';
        $post->translateOrNew('ar')->content = 'محتوي باللغه العربية';

        $post->save();

        return response()->json(['message' => 'Post created successfully']);
    }

    public function show($id)
    {
        $post = Post::find($id);

        if ($post) {
            $translations = [
                'en' => [
                    'title' => $post->translate('en')->title,
                    'content' => $post->translate('en')->content,
                ],
                'ar' => [
                    'title' => $post->translate('ar')->title,
                    'content' => $post->translate('ar')->content,
                ],
            ];

            return response()->json($translations);
        } else {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }

}
