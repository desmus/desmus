<?php

namespace App\Repositories;

use App\Models\SharedProfileFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileFileRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:27 pm UTC
 *
 * @method SharedProfileFile findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileFile find($id, $columns = ['*'])
 * @method SharedProfileFile first($columns = ['*'])
*/
class SharedProfileFileRepository extends BaseRepository
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
        return SharedProfileFile::class;
    }
}
