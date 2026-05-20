<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BreakingNews;
use App\Models\Article;

class AdminBreakingNewsController extends Controller
{
    public function index()
    {
        $breakingNews = BreakingNews::firstOrCreate([], [
            'mode' => 'custom',
            'content' => 'Ibukota Nusantara Siap Diresmikan Bulan Depan. • Presiden Kunjungi Papua Untuk Proyek Strategis. • Kurs Rupiah Menguat Terhadap Dollar AS. • NDN'
        ]);

        // Get 15 popular/approved articles to select from
        $articles = Article::where('status', 'approved')
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->orderByDesc('view_count')
            ->take(15)
            ->get();

        return view('admin.breaking', compact('breakingNews', 'articles'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'mode' => 'required|in:custom,article',
            'content' => 'required_if:mode,custom|nullable|string|max:500',
            'article_id' => 'required_if:mode,article|nullable|exists:articles,id',
        ]);

        $breakingNews = BreakingNews::first();
        if (!$breakingNews) {
            $breakingNews = new BreakingNews();
        }

        $breakingNews->mode = $request->mode;
        $breakingNews->content = $request->mode === 'custom' ? $request->content : null;
        $breakingNews->article_id = $request->mode === 'article' ? $request->article_id : null;
        $breakingNews->save();

        return redirect()->back()->with('success', 'Breaking News berhasil diperbarui.');
    }
}
