<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProjectTopicView
 * @package App\Models
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @property \App\Models\ProjectTopic projectTopic
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection collegeCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSFileCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSFileDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSFileUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSFileViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryImageCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryImageDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryImageUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryImageViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSGaleryViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTSNoteCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSNoteDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSNoteUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSNoteViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolFileCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolFileDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolFileUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolFileViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTSToolViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicSectionCreates
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicSectionDeletes
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicSectionUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicSectionViews
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeTopicViews
 * @property \Illuminate\Database\Eloquent\Collection collegeUpdates
 * @property \Illuminate\Database\Eloquent\Collection collegeViews
 * @property \Illuminate\Database\Eloquent\Collection jobCreates
 * @property \Illuminate\Database\Eloquent\Collection jobDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSFileCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTSFileDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSFileUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTSFileViews
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryImageCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryImageDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryImageUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryImageViews
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTSGaleryViews
 * @property \Illuminate\Database\Eloquent\Collection jobTSNoteCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTSNoteDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSNoteUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTSNoteViews
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolFileCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolFileDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolFileUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolFileViews
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTSToolViews
 * @property \Illuminate\Database\Eloquent\Collection jobTopicCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTopicDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTopicSectionCreates
 * @property \Illuminate\Database\Eloquent\Collection jobTopicSectionDeletes
 * @property \Illuminate\Database\Eloquent\Collection jobTopicSectionUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTopicSectionViews
 * @property \Illuminate\Database\Eloquent\Collection jobTopicUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobTopicViews
 * @property \Illuminate\Database\Eloquent\Collection jobUpdates
 * @property \Illuminate\Database\Eloquent\Collection jobViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSFileCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSFileDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSFileUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSFileViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGaleryCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGaleryDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGaleryImageCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGaleryImageDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGaleryImageUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGaleryImageViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGaleryUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSGaleryViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSNoteCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSNoteDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSNoteUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSNoteViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSToolCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSToolDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSToolFileCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSToolFileDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSToolFileUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSToolFileViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSToolUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTSToolViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicSectionCreates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicSectionDeletes
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicSectionUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicSectionViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataTopicViews
 * @property \Illuminate\Database\Eloquent\Collection personalDataUpdates
 * @property \Illuminate\Database\Eloquent\Collection personalDataViews
 * @property \Illuminate\Database\Eloquent\Collection projectCreates
 * @property \Illuminate\Database\Eloquent\Collection projectDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSFileCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTSFileDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSFileUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTSFileViews
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryImageCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryImageDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryImageUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryImageViews
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTSGaleryViews
 * @property \Illuminate\Database\Eloquent\Collection projectTSNoteCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTSNoteDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSNoteUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTSNoteViews
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolFileCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolFileDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolFileUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolFileViews
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTSToolViews
 * @property \Illuminate\Database\Eloquent\Collection projectTopicCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTopicDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTopicSectionCreates
 * @property \Illuminate\Database\Eloquent\Collection projectTopicSectionDeletes
 * @property \Illuminate\Database\Eloquent\Collection projectTopicSectionUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectTopicSectionViews
 * @property \Illuminate\Database\Eloquent\Collection projectTopicUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectUpdates
 * @property \Illuminate\Database\Eloquent\Collection projectViews
 * @property \Illuminate\Database\Eloquent\Collection userCollegeTSFiles
 * @property \Illuminate\Database\Eloquent\Collection userCollegeTSGaleries
 * @property \Illuminate\Database\Eloquent\Collection userCollegeTSGaleryImages
 * @property \Illuminate\Database\Eloquent\Collection userCollegeTSNotes
 * @property \Illuminate\Database\Eloquent\Collection userCollegeTSToolFiles
 * @property \Illuminate\Database\Eloquent\Collection userCollegeTSTools
 * @property \Illuminate\Database\Eloquent\Collection userCollegeTopicSections
 * @property \Illuminate\Database\Eloquent\Collection userCollegeTopics
 * @property \Illuminate\Database\Eloquent\Collection userColleges
 * @property \Illuminate\Database\Eloquent\Collection userJobTSFiles
 * @property \Illuminate\Database\Eloquent\Collection userJobTSGaleries
 * @property \Illuminate\Database\Eloquent\Collection userJobTSGaleryImages
 * @property \Illuminate\Database\Eloquent\Collection userJobTSNotes
 * @property \Illuminate\Database\Eloquent\Collection userJobTSToolFiles
 * @property \Illuminate\Database\Eloquent\Collection userJobTSTools
 * @property \Illuminate\Database\Eloquent\Collection userJobTopicSections
 * @property \Illuminate\Database\Eloquent\Collection userJobTopics
 * @property \Illuminate\Database\Eloquent\Collection userJobs
 * @property \Illuminate\Database\Eloquent\Collection userPersonalDataTSFiles
 * @property \Illuminate\Database\Eloquent\Collection userPersonalDataTSGaleries
 * @property \Illuminate\Database\Eloquent\Collection userPersonalDataTSGaleryImages
 * @property \Illuminate\Database\Eloquent\Collection userPersonalDataTSNotes
 * @property \Illuminate\Database\Eloquent\Collection userPersonalDataTSToolFiles
 * @property \Illuminate\Database\Eloquent\Collection userPersonalDataTSTools
 * @property \Illuminate\Database\Eloquent\Collection userPersonalDataTopicSections
 * @property \Illuminate\Database\Eloquent\Collection userPersonalDataTopics
 * @property \Illuminate\Database\Eloquent\Collection userPersonalDatas
 * @property \Illuminate\Database\Eloquent\Collection userProjectTSFiles
 * @property \Illuminate\Database\Eloquent\Collection userProjectTSGaleries
 * @property \Illuminate\Database\Eloquent\Collection userProjectTSGaleryImages
 * @property \Illuminate\Database\Eloquent\Collection userProjectTSNotes
 * @property \Illuminate\Database\Eloquent\Collection userProjectTSToolFiles
 * @property \Illuminate\Database\Eloquent\Collection userProjectTSTools
 * @property \Illuminate\Database\Eloquent\Collection userProjectTopicSections
 * @property \Illuminate\Database\Eloquent\Collection userProjectTopics
 * @property \Illuminate\Database\Eloquent\Collection userProjects
 * @property string|\Carbon\Carbon datetime
 * @property integer user_id
 * @property integer project_topic_id
 */
class ProjectTopicView extends Model
{
    use SoftDeletes;

    public $table = 'project_topic_views';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'datetime',
        'user_id',
        'project_topic_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'project_topic_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function projectTopic()
    {
        return $this->belongsTo(\App\Models\ProjectTopic::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
