<?php

namespace App\Repositories;

use App\Models\ContactUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactUpdateRepository
 * @package App\Repositories
 * @version May 16, 2018, 11:03 pm UTC
 *
 * @method ContactUpdate findWithoutFail($id, $columns = ['*'])
 * @method ContactUpdate find($id, $columns = ['*'])
 * @method ContactUpdate first($columns = ['*'])
*/
class ContactUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'contact_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactUpdate::class;
    }
}
