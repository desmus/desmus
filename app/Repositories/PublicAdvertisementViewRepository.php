<?php

namespace App\Repositories;

use App\Models\PublicAdvertisementView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicAdvertisementViewRepository
 * @package App\Repositories
 * @version January 20, 2019, 3:46 am UTC
 *
 * @method PublicAdvertisementView findWithoutFail($id, $columns = ['*'])
 * @method PublicAdvertisementView find($id, $columns = ['*'])
 * @method PublicAdvertisementView first($columns = ['*'])
*/
class PublicAdvertisementViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'public_advertisement_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicAdvertisementView::class;
    }
}
