<?php

namespace App\Repositories;

use App\Models\PublicFileUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicFileUpdateRepository
 * @package App\Repositories
 * @version January 19, 2019, 9:10 pm UTC
 *
 * @method PublicFileUpdate findWithoutFail($id, $columns = ['*'])
 * @method PublicFileUpdate find($id, $columns = ['*'])
 * @method PublicFileUpdate first($columns = ['*'])
*/
class PublicFileUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'public_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicFileUpdate::class;
    }
}
