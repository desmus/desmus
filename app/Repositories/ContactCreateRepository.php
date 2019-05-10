<?php

namespace App\Repositories;

use App\Models\ContactCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactCreateRepository
 * @package App\Repositories
 * @version May 16, 2018, 11:03 pm UTC
 *
 * @method ContactCreate findWithoutFail($id, $columns = ['*'])
 * @method ContactCreate find($id, $columns = ['*'])
 * @method ContactCreate first($columns = ['*'])
*/
class ContactCreateRepository extends BaseRepository
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
        return ContactCreate::class;
    }
}
