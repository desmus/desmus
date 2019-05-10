<?php

namespace App\Repositories;

use App\Models\SharedProfileAudio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileAudioRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:27 pm UTC
 *
 * @method SharedProfileAudio findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileAudio find($id, $columns = ['*'])
 * @method SharedProfileAudio first($columns = ['*'])
*/
class SharedProfileAudioRepository extends BaseRepository
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
        return SharedProfileAudio::class;
    }
}
