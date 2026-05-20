<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BreakingNews extends Model
{
    protected $table = 'breaking_news';

    protected $fillable = [
        'mode',
        'content',
        'article_id',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
