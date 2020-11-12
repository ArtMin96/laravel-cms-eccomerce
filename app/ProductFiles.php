<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $product_id
 * @property integer $bx_file_id
 * @property integer $bx_folder_id
 * @property string $url
 * @property string $file
 * @property string $preview_image
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Product $product
 */
class ProductFiles extends Model
{
    use SoftDeletes;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'url', 'file', 'preview_image', 'deleted_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @param $productId
     * @param $file
     * @param null $preview
     * @return ProductFiles|null
     */
    public static function createFile($productId, $file)
    {
        $productFiles = new ProductFiles();

        if ($file->hasFile('file')) {
            $fileName = time().'_'.str_replace(' ', '_', $file->file->getClientOriginalName());
            $filePath = $file->file('file')->storeAs('products', $fileName, 'public');

            $productFiles->product_id = $productId;
            $productFiles->file = $fileName;
            $productFiles->url = '/storage/' . $filePath;
        }

        if ($file->hasFile('preview_image')) {
            $previewFileName = time().'_'.str_replace(' ', '_', $file->preview_image->getClientOriginalName());
            $previewFilePath = $file->file('preview_image')->storeAs('products', $previewFileName, 'public');

            $productFiles->preview_image = $previewFilePath;
        }

        if ($productFiles->save()) {
            return $productFiles;
        } else {
            return null;
        }
    }
}
