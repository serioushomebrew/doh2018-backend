<?php

namespace App\Transformers;

use App\File;
use League\Fractal\TransformerAbstract;

class FileTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param File $file
     * @return array
     */
    public function transform(File $file): array
    {
        return [
            'name'        => $file->name,
            'description' => $file->description,
            'size'        => $file->size,
        ];
    }
}
