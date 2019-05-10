<?php

namespace App\Repositories;

use App\Models\PublicFileLike;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicFileLikeRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:23 pm UTC
 *
 * @method PublicFileLike findWithoutFail($id, $columns = ['*'])
 * @method PublicFileLike find($id, $columns = ['*'])
 * @method PublicFileLike first($columns = ['*'])
*/
class PublicFileLikeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status',
        'datetime',
        'public_file_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicFileLike::class;
    }
}
