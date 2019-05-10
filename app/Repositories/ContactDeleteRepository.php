<?php

namespace App\Repositories;

use App\Models\ContactDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactDeleteRepository
 * @package App\Repositories
 * @version May 16, 2018, 11:03 pm UTC
 *
 * @method ContactDelete findWithoutFail($id, $columns = ['*'])
 * @method ContactDelete find($id, $columns = ['*'])
 * @method ContactDelete first($columns = ['*'])
*/
class ContactDeleteRepository extends BaseRepository
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
        return ContactDelete::class;
    }
}
