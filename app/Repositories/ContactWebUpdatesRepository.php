<?php

namespace App\Repositories;

use App\Models\ContactWebUpdates;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactWebUpdatesRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:22 pm UTC
 *
 * @method ContactWebUpdates findWithoutFail($id, $columns = ['*'])
 * @method ContactWebUpdates find($id, $columns = ['*'])
 * @method ContactWebUpdates first($columns = ['*'])
*/
class ContactWebUpdatesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'contact_web_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactWebUpdates::class;
    }
}
