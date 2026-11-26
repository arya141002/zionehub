<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use App\Models\Certificate;
use App\Models\ContactMessage;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing', [
            'site'        => SiteSetting::current(),
            'profile'     => Profile::first(),
            'certificates' => Certificate::where('is_published', true)->latest()->get(),
            'socialLinks' => SocialLink::where('is_published', true)->orderBy('sort_order')->get(),
            'skills'      => Skill::where('is_published', true)->orderBy('sort_order')->get()->groupBy('category'),
            'educations'  => Education::where('is_published', true)->orderBy('start_date')->get(),
            'experiences' => Experience::where('is_published', true)->orderByDesc('start_date')->get(),
            'projects'    => Project::where('is_published', true)->orderByDesc('is_featured')->orderBy('sort_order')->get(),
            'articles'    => Post::where('is_featured', true)->orderByDesc('published_at')->get(),
        ]);
    }

    public function showPost(Post $post)
    {
        abort_if(is_null($post->published_at) || $post->published_at->isFuture(), 404);

        return view('blog.show', [
            'site'        => SiteSetting::current(),
            'profile'     => Profile::first(),
            'post'        => $post,
            'socialLinks' => SocialLink::where('is_published', true)->orderBy('sort_order')->get(),
        ]);
    }
}