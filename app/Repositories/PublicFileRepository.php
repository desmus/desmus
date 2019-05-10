<?php

namespace App\Repositories;

use App\Models\PublicFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicFileRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:22 pm UTC
 *
 * @method PublicFile findWithoutFail($id, $columns = ['*'])
 * @method PublicFile find($id, $columns = ['*'])
 * @method PublicFile first($columns = ['*'])
*/
class PublicFileRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'file_type',
        'file_size',
        'views_quantity',
        'updates_quantity',
        'status',
        'datetime',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicFile::class;
    }
}
