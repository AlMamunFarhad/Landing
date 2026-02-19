<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'is_published',
        'button_text',
        'contact_number',
        'hero_title',
        'hero_subtitle',
        'hero_youtube_link',
        'product_title',
        'product_subtitle',
        'product_image',
        'why_trust_us_title',
        'why_trust_us_description',
        'why_trust_us_image',
        'why_choose_title',
        'why_choose_description',
        'product_id',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'product_id' => 'array',
        'product_subtitle' => 'string',
    ];

    // helper to return product ids as comma-separated string (useful for form)
    public function productIdsString(): string
    {
        if (empty($this->product_id)) return '';
        return implode(',', $this->product_id);
    }

    // Enable route-model-binding by slug instead of id
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
