<?php

namespace App\Repositories;

use App\Models\SharedProfileVideo;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileVideoRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:28 pm UTC
 *
 * @method SharedProfileVideo findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileVideo find($id, $columns = ['*'])
 * @method SharedProfileVideo first($columns = ['*'])
*/
class SharedProfileVideoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'file_type',
        'file_size',
        'link',
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
        return SharedProfileVideo::class;
    }
}
