<?php

namespace App\Repositories;

use App\Models\PublicVideoUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicVideoUpdateRepository
 * @package App\Repositories
 * @version January 19, 2019, 9:10 pm UTC
 *
 * @method PublicVideoUpdate findWithoutFail($id, $columns = ['*'])
 * @method PublicVideoUpdate find($id, $columns = ['*'])
 * @method PublicVideoUpdate first($columns = ['*'])
*/
class PublicVideoUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'public_video_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicVideoUpdate::class;
    }
}
