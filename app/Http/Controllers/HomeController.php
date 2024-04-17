<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class DashboardController extends Controller
{
    /**
     * Display the user's dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $latestPosts = Post::latest()->take(5)->get();
        return view('home', compact('latestPosts'));
    }
}
