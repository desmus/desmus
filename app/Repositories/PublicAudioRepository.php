<?php

namespace App\Repositories;

use App\Models\PublicAudio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicAudioRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:22 pm UTC
 *
 * @method PublicAudio findWithoutFail($id, $columns = ['*'])
 * @method PublicAudio find($id, $columns = ['*'])
 * @method PublicAudio first($columns = ['*'])
*/
class PublicAudioRepository extends BaseRepository
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
        return PublicAudio::class;
    }
}
