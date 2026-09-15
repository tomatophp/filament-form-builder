<?php

namespace TomatoPHP\FilamentFormBuilder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;
use TomatoPHP\FilamentFormBuilder\Database\Factories\FormFactory;

/**
 * @property int $id
 * @property string $type
 * @property string $name
 * @property string $key
 * @property string $endpoint
 * @property string $method
 * @property string $description
 * @property bool $is_active
 * @property string $created_at
 * @property string $updated_at
 */
class Form extends Model
{
    use HasFactory;
    use HasTranslations;

    protected static function newFactory(): FormFactory
    {
        return FormFactory::new();
    }

    public $translatable = ['title', 'description'];

    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'title',
        'key',
        'endpoint',
        'method',
        'description',
        'is_active',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * @return BelongsToMany
     */
    public function fields()
    {
        return $this->hasMany(FormOption::class, 'form_id', 'id')->orderBy('order', 'asc');
    }

    public function requests()
    {
        return $this->hasMany(FormRequest::class, 'form_id', 'id');
    }
}
