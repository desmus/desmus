<?php

namespace App\Repositories;

use App\Models\PublicAdvertisementCResponse;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicAdvertisementCResponseRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:24 pm UTC
 *
 * @method PublicAdvertisementCResponse findWithoutFail($id, $columns = ['*'])
 * @method PublicAdvertisementCResponse find($id, $columns = ['*'])
 * @method PublicAdvertisementCResponse first($columns = ['*'])
*/
class PublicAdvertisementCResponseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        'public_a_c_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicAdvertisementCResponse::class;
    }
}
