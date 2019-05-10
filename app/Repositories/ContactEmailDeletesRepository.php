<?php

namespace App\Repositories;

use App\Models\ContactEmailDeletes;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactEmailDeletesRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:21 pm UTC
 *
 * @method ContactEmailDeletes findWithoutFail($id, $columns = ['*'])
 * @method ContactEmailDeletes find($id, $columns = ['*'])
 * @method ContactEmailDeletes first($columns = ['*'])
*/
class ContactEmailDeletesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'contact_email_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactEmailDeletes::class;
    }
}
