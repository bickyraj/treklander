<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use App\Team;
use TOC\MarkupFixer;
use TOC\TocGenerator;

class BlogController extends Controller
{
	public function index()
	{
		$blogs = Blog::where('status', '=', 1)->orderBy('blog_date', 'desc')->paginate(12);
		return view('front.blogs.index', compact('blogs'));
	}

	public function show($slug)
	{
		$blog = Blog::where('slug', '=', $slug)->with('similar_blogs')->first();
		$toc = $blog->toc;
		if ($toc != "") {
			$markupFixer  = new MarkupFixer();
			$tocGenerator = new TocGenerator();
			$body = $markupFixer->fix($toc);
			$contents = $tocGenerator->getHTMLMenu($body);
		} else {
			$body = "";
			$contents = "";
		}

		$author = Team::where('id', 2)->first();

		$blogs = Blog::limit(3)->latest()->get();
		return view('front.blogs.show', compact('blog', 'blogs', 'contents', 'body', 'author'));
	}
}
