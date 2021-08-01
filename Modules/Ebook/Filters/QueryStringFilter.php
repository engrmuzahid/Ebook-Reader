<?php

namespace Modules\Ebook\Filters;
use Illuminate\Database\Query\JoinClause;

class QueryStringFilter
{
    private $sorts = [
        'latest',
        'relevance',
        'alphabetic',
        'toprated',
        
    ];

    public function sort($query, $sortType)
    {
        if ($this->sortTypeExists($sortType)) {
            return $this->{$sortType}($query);
        }
    }

    private function sortTypeExists($sortType)
    {
        return in_array(strtolower($sortType), $this->sorts);
    }

    public function relevance()
    {
        // Ebook are searched by relevant order by default.
    }

    public function alphabetic($query)
    {
        
        
        $query->join('ebook_translations', function (JoinClause $join) {
            $join->on('ebooks.id', '=', 'ebook_translations.ebook_id');
        })
        ->selectRaw('ebook_translations.title,ebook_translations.locale')
        ->whereIn('ebook_translations.locale', [locale()])
        ->groupBy([
                    'ebook_translations.title',
                    'ebook_translations.locale',
                    'ebooks.id',
                    'slug',
                    'user_id',
                    'publication_year',
                    'file_type',
                    'file_url',
                    'embed_code',
                    'isbn',
                    'price',
                    'buy_url',
                    'viewed',
                    'password',
                    'is_featured',
                    'is_active',
                    'is_private',
                    'user_id',
                    'ebooks.created_at',
                    'ebooks.deleted_at',
                    'ebooks.updated_at',
                    
                ])
        ->orderBy('ebook_translations.title');
    }

    public function topRated($query)
    {
         $query->leftJoin('reviews', 'ebooks.id', '=', 'reviews.ebook_id')
            ->selectRaw('AVG(reviews.rating) as avg_rating')
            ->groupBy([
                'ebooks.id',
                'slug',
                'user_id',
                'file_type',
                'file_url',
                'embed_code',
                'isbn',
                'price',
                'buy_url',
                'publication_year',
                'viewed',
                'password',
                'is_featured',
                'is_active',
                'is_private',
                'user_id',
                'ebooks.created_at',
            ])
            ->orderByDesc('avg_rating'); 
    }

    public function latest($query)
    {
        $query->latest();
    }
    
    public function category($query, $slug)
    {
        $query->whereHas('categories', function ($categoryQuery) use ($slug) {
            $categoryQuery->where('slug', $slug);
        });
    }

}
