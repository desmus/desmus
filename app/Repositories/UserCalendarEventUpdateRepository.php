<?php

namespace App\Repositories;

use App\Models\UserCalendarEventUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCalendarEventUpdateRepository
 * @package App\Repositories
 * @version January 23, 2019, 7:32 pm UTC
 *
 * @method UserCalendarEventUpdate findWithoutFail($id, $columns = ['*'])
 * @method UserCalendarEventUpdate find($id, $columns = ['*'])
 * @method UserCalendarEventUpdate first($columns = ['*'])
*/
class UserCalendarEventUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_c_e_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCalendarEventUpdate::class;
    }
}
