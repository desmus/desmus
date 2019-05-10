<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Cashier\Billable;

/**
 * Class User
 * @package App\Models
 * @version September 14, 2018, 5:58 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection CalendarEventCreate
 * @property \Illuminate\Database\Eloquent\Collection CalendarEventDelete
 * @property \Illuminate\Database\Eloquent\Collection CalendarEventUpdate
 * @property \Illuminate\Database\Eloquent\Collection CalendarEventView
 * @property \Illuminate\Database\Eloquent\Collection CalendarEvent
 * @property \Illuminate\Database\Eloquent\Collection CollegeCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSFileCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSFileDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSFileTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSFileTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSFileTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSFileTodolistView
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSFileUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSFileView
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSGImageTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSGImageTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSGImageTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSGImageTodolistView
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSGaleryCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSGaleryDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSGaleryImageCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSGaleryImageDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSGaleryImageUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSGaleryImageView
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSGaleryTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSGaleryTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSGaleryTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSGaleryTodolistView
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSGaleryUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSGaleryView
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSNoteCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSNoteDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSNoteTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSNoteTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSNoteTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSNoteTodolistView
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSNoteUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSNoteView
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSPAudioCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSPAudioDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSPAudioUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSPAudioView
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSPTCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSPTDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSPTUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSPTView
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSToolCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSToolDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSToolFileCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSToolFileDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSToolFileTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSToolFileTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSToolFileTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSToolFileTodolistView
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSToolFileUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSToolFileView
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSToolTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSToolTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSToolTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSToolTodolistView
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSToolUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTSToolView
 * @property \Illuminate\Database\Eloquent\Collection CollegeTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTodolistView
 * @property \Illuminate\Database\Eloquent\Collection CollegeTopicCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTopicDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTopicSectionCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTopicSectionDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTopicSectionTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTopicSectionTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTopicSectionTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTopicSectionTodolistView
 * @property \Illuminate\Database\Eloquent\Collection CollegeTopicSectionUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTopicSectionView
 * @property \Illuminate\Database\Eloquent\Collection CollegeTopicTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTopicTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection CollegeTopicTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTopicTodolistView
 * @property \Illuminate\Database\Eloquent\Collection CollegeTopicUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeTopicView
 * @property \Illuminate\Database\Eloquent\Collection CollegeUpdate
 * @property \Illuminate\Database\Eloquent\Collection CollegeView
 * @property \Illuminate\Database\Eloquent\Collection College
 * @property \Illuminate\Database\Eloquent\Collection ContactAddressCreate
 * @property \Illuminate\Database\Eloquent\Collection ContactAddressDelete
 * @property \Illuminate\Database\Eloquent\Collection ContactAddressUpdate
 * @property \Illuminate\Database\Eloquent\Collection ContactAddressView
 * @property \Illuminate\Database\Eloquent\Collection ContactCreate
 * @property \Illuminate\Database\Eloquent\Collection ContactDelete
 * @property \Illuminate\Database\Eloquent\Collection ContactEmailCreate
 * @property \Illuminate\Database\Eloquent\Collection ContactEmailDelete
 * @property \Illuminate\Database\Eloquent\Collection ContactEmailUpdate
 * @property \Illuminate\Database\Eloquent\Collection ContactEmailView
 * @property \Illuminate\Database\Eloquent\Collection ContactSocialCreate
 * @property \Illuminate\Database\Eloquent\Collection ContactSocialDelete
 * @property \Illuminate\Database\Eloquent\Collection ContactSocialUpdate
 * @property \Illuminate\Database\Eloquent\Collection ContactSocialView
 * @property \Illuminate\Database\Eloquent\Collection ContactTelephoneCreate
 * @property \Illuminate\Database\Eloquent\Collection ContactTelephoneDelete
 * @property \Illuminate\Database\Eloquent\Collection ContactTelephoneUpdate
 * @property \Illuminate\Database\Eloquent\Collection ContactTelephoneView
 * @property \Illuminate\Database\Eloquent\Collection ContactUpdate
 * @property \Illuminate\Database\Eloquent\Collection ContactView
 * @property \Illuminate\Database\Eloquent\Collection ContactWebCreate
 * @property \Illuminate\Database\Eloquent\Collection ContactWebDelete
 * @property \Illuminate\Database\Eloquent\Collection ContactWebUpdate
 * @property \Illuminate\Database\Eloquent\Collection ContactWebView
 * @property \Illuminate\Database\Eloquent\Collection Contact
 * @property \Illuminate\Database\Eloquent\Collection JobCreate
 * @property \Illuminate\Database\Eloquent\Collection JobDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTSFileCreate
 * @property \Illuminate\Database\Eloquent\Collection JobTSFileDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTSFileTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection JobTSFileTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTSFileTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobTSFileTodolistView
 * @property \Illuminate\Database\Eloquent\Collection JobTSFileUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobTSFileView
 * @property \Illuminate\Database\Eloquent\Collection JobTSGImageTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection JobTSGImageTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTSGImageTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobTSGImageTodolistView
 * @property \Illuminate\Database\Eloquent\Collection JobTSGaleryCreate
 * @property \Illuminate\Database\Eloquent\Collection JobTSGaleryDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTSGaleryImageCreate
 * @property \Illuminate\Database\Eloquent\Collection JobTSGaleryImageCreates
 * @property \Illuminate\Database\Eloquent\Collection JobTSGaleryImageDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTSGaleryImageDeletes
 * @property \Illuminate\Database\Eloquent\Collection JobTSGaleryImageUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobTSGaleryImageUpdates
 * @property \Illuminate\Database\Eloquent\Collection JobTSGaleryImageView
 * @property \Illuminate\Database\Eloquent\Collection JobTSGaleryImageViews
 * @property \Illuminate\Database\Eloquent\Collection JobTSGaleryTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection JobTSGaleryTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTSGaleryTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobTSGaleryTodolistView
 * @property \Illuminate\Database\Eloquent\Collection JobTSGaleryUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobTSGaleryView
 * @property \Illuminate\Database\Eloquent\Collection JobTSNoteCreate
 * @property \Illuminate\Database\Eloquent\Collection JobTSNoteDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTSNoteTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection JobTSNoteTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTSNoteTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobTSNoteTodolistView
 * @property \Illuminate\Database\Eloquent\Collection JobTSNoteUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobTSNoteView
 * @property \Illuminate\Database\Eloquent\Collection JobTSPAudioCreate
 * @property \Illuminate\Database\Eloquent\Collection JobTSPAudioDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTSPAudioUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobTSPAudioView
 * @property \Illuminate\Database\Eloquent\Collection JobTSPTCreate
 * @property \Illuminate\Database\Eloquent\Collection JobTSPTDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTSPTUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobTSPTView
 * @property \Illuminate\Database\Eloquent\Collection JobTSToolCreate
 * @property \Illuminate\Database\Eloquent\Collection JobTSToolDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTSToolFileCreate
 * @property \Illuminate\Database\Eloquent\Collection JobTSToolFileDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTSToolFileTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection JobTSToolFileTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTSToolFileTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobTSToolFileTodolistView
 * @property \Illuminate\Database\Eloquent\Collection JobTSToolFileUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobTSToolFileView
 * @property \Illuminate\Database\Eloquent\Collection JobTSToolTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection JobTSToolTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTSToolTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobTSToolTodolistView
 * @property \Illuminate\Database\Eloquent\Collection JobTSToolUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobTSToolView
 * @property \Illuminate\Database\Eloquent\Collection JobTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection JobTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobTodolistView
 * @property \Illuminate\Database\Eloquent\Collection JobTopicCreate
 * @property \Illuminate\Database\Eloquent\Collection JobTopicDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTopicSectionCreate
 * @property \Illuminate\Database\Eloquent\Collection JobTopicSectionDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTopicSectionTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection JobTopicSectionTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTopicSectionTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobTopicSectionTodolistView
 * @property \Illuminate\Database\Eloquent\Collection JobTopicSectionUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobTopicSectionView
 * @property \Illuminate\Database\Eloquent\Collection JobTopicTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection JobTopicTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection JobTopicTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobTopicTodolistView
 * @property \Illuminate\Database\Eloquent\Collection JobTopicUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobTopicView
 * @property \Illuminate\Database\Eloquent\Collection JobUpdate
 * @property \Illuminate\Database\Eloquent\Collection JobView
 * @property \Illuminate\Database\Eloquent\Collection Job
 * @property \Illuminate\Database\Eloquent\Collection MessageCreate
 * @property \Illuminate\Database\Eloquent\Collection MessageDelete
 * @property \Illuminate\Database\Eloquent\Collection MessageView
 * @property \Illuminate\Database\Eloquent\Collection Message
 * @property \Illuminate\Database\Eloquent\Collection PDTSPAudioCreate
 * @property \Illuminate\Database\Eloquent\Collection PDTSPAudioDelete
 * @property \Illuminate\Database\Eloquent\Collection PDTSPAudioUpdate
 * @property \Illuminate\Database\Eloquent\Collection PDTSPAudioView
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataCreate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataDelete
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSFTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSFTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSFTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSFTodolistView
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSFileCreate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSFileDelete
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSFileUpdate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSFileView
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSGITodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSGITodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSGITodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSGITodolistView
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSGTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSGTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSGTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSGTodolistView
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSGaleryCreate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSGaleryDelete
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSGaleryImageCreate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSGaleryImageDelete
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSGaleryImageUpdate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSGaleryImageView
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSGaleryUpdate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSGaleryView
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSNTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSNTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSNTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSNTodolistView
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSNoteCreate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSNoteDelete
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSNoteUpdate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSNoteView
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSPTCreate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSPTDelete
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSPTUpdate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSPTView
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSTFTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSTFTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSTFTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSTFTodolistView
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSTTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSTTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSTTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSTTodolistView
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSTodolistView
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSToolCreate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSToolDelete
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSToolFileCreate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSToolFileDelete
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSToolFileUpdate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSToolFileView
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSToolUpdate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTSToolView
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTodolistView
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTopicCreate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTopicDelete
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTopicSectionCreate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTopicSectionDelete
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTopicSectionUpdate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTopicSectionView
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTopicTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTopicTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTopicTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTopicTodolistView
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTopicUpdate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataTopicView
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataUpdate
 * @property \Illuminate\Database\Eloquent\Collection PersonalDataView
 * @property \Illuminate\Database\Eloquent\Collection PersonalData
 * @property \Illuminate\Database\Eloquent\Collection ProjectCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSFileCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSFileDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSFileTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSFileTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSFileTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSFileTodolistView
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSFileUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSFileView
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSGImageTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSGImageTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSGImageTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSGImageTodolistView
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSGaleryCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSGaleryDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSGaleryImageCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSGaleryImageDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSGaleryImageUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSGaleryImageView
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSGaleryTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSGaleryTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSGaleryTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSGaleryTodolistView
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSGaleryUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSGaleryView
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSNoteCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSNoteDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSNoteTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSNoteTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSNoteTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSNoteTodolistView
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSNoteUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSNoteView
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSPAudioCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSPAudioDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSPAudioUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSPAudioView
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSPTCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSPTDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSPTUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSPTView
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSToolCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSToolDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSToolFileCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSToolFileDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSToolFileTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSToolFileTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSToolFileTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSToolFileTodolistView
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSToolFileUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSToolFileView
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSToolTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSToolTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSToolTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSToolTodolistView
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSToolUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTSToolView
 * @property \Illuminate\Database\Eloquent\Collection ProjectTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTodolistView
 * @property \Illuminate\Database\Eloquent\Collection ProjectTopicCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTopicDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTopicSectionCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTopicSectionDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTopicSectionTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTopicSectionTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTopicSectionTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTopicSectionTodolistView
 * @property \Illuminate\Database\Eloquent\Collection ProjectTopicSectionUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTopicSectionView
 * @property \Illuminate\Database\Eloquent\Collection ProjectTopicTodolistCreate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTopicTodolistDelete
 * @property \Illuminate\Database\Eloquent\Collection ProjectTopicTodolistUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTopicTodolistView
 * @property \Illuminate\Database\Eloquent\Collection ProjectTopicUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectTopicView
 * @property \Illuminate\Database\Eloquent\Collection ProjectUpdate
 * @property \Illuminate\Database\Eloquent\Collection ProjectView
 * @property \Illuminate\Database\Eloquent\Collection Project
 * @property \Illuminate\Database\Eloquent\Collection RecentActivity
 * @property \Illuminate\Database\Eloquent\Collection RecentActivityCreate
 * @property \Illuminate\Database\Eloquent\Collection RecentActivityDelete
 * @property \Illuminate\Database\Eloquent\Collection RecentActivityUpdate
 * @property \Illuminate\Database\Eloquent\Collection RecentActivityView
 * @property \Illuminate\Database\Eloquent\Collection UCTSPAudioCreate
 * @property \Illuminate\Database\Eloquent\Collection UCTSPAudioDelete
 * @property \Illuminate\Database\Eloquent\Collection UCTSPAudioUpdate
 * @property \Illuminate\Database\Eloquent\Collection UCTSPlaylistCreate
 * @property \Illuminate\Database\Eloquent\Collection UCTSPlaylistDelete
 * @property \Illuminate\Database\Eloquent\Collection UCTSPlaylistUpdate
 * @property \Illuminate\Database\Eloquent\Collection UJTSPAudioCreate
 * @property \Illuminate\Database\Eloquent\Collection UJTSPAudioDelete
 * @property \Illuminate\Database\Eloquent\Collection UJTSPAudioUpdate
 * @property \Illuminate\Database\Eloquent\Collection UJTSPlaylistCreate
 * @property \Illuminate\Database\Eloquent\Collection UJTSPlaylistDelete
 * @property \Illuminate\Database\Eloquent\Collection UJTSPlaylistUpdate
 * @property \Illuminate\Database\Eloquent\Collection UPDTSPAudioCreate
 * @property \Illuminate\Database\Eloquent\Collection UPDTSPAudioDelete
 * @property \Illuminate\Database\Eloquent\Collection UPDTSPAudioUpdate
 * @property \Illuminate\Database\Eloquent\Collection UPDTSPlaylistCreate
 * @property \Illuminate\Database\Eloquent\Collection UPDTSPlaylistDelete
 * @property \Illuminate\Database\Eloquent\Collection UPDTSPlaylistUpdate
 * @property \Illuminate\Database\Eloquent\Collection UPTSPAudioCreate
 * @property \Illuminate\Database\Eloquent\Collection UPTSPAudioDelete
 * @property \Illuminate\Database\Eloquent\Collection UPTSPAudioUpdate
 * @property \Illuminate\Database\Eloquent\Collection UPTSPlaylistCreate
 * @property \Illuminate\Database\Eloquent\Collection UPTSPlaylistDelete
 * @property \Illuminate\Database\Eloquent\Collection UPTSPlaylistUpdate
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeC
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeD
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSFileC
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSFileD
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSFileU
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSFile
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSGalerieC
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSGalerieD
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSGalerieU
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSGalery
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSGaleryImageC
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSGaleryImageD
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSGaleryImageU
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSGaleryImage
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSNoteC
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSNoteD
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSNoteU
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSNote
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSPAudio
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSPlaylist
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSToolC
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSToolD
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSToolFileC
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSToolFileD
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSToolFileU
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSToolFile
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSToolU
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTSTool
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTopicC
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTopicD
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTopicSectionC
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTopicSectionD
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTopicSectionU
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTopicSection
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTopicU
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeTopic
 * @property \Illuminate\Database\Eloquent\Collection UserCollegeU
 * @property \Illuminate\Database\Eloquent\Collection UserCollege
 * @property \Illuminate\Database\Eloquent\Collection UserJobC
 * @property \Illuminate\Database\Eloquent\Collection UserJobD
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSFileC
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSFileD
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSFileU
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSFile
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSGalerieC
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSGalerieD
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSGalerieU
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSGalery
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSGaleryImageC
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSGaleryImageD
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSGaleryImageU
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSGaleryImage
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSNoteC
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSNoteD
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSNoteU
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSNote
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSPAudio
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSPlaylist
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSToolC
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSToolD
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSToolFileC
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSToolFileD
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSToolFileU
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSToolFile
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSToolU
 * @property \Illuminate\Database\Eloquent\Collection UserJobTSTool
 * @property \Illuminate\Database\Eloquent\Collection UserJobTopicC
 * @property \Illuminate\Database\Eloquent\Collection UserJobTopicD
 * @property \Illuminate\Database\Eloquent\Collection UserJobTopicSectionC
 * @property \Illuminate\Database\Eloquent\Collection UserJobTopicSectionD
 * @property \Illuminate\Database\Eloquent\Collection UserJobTopicSectionU
 * @property \Illuminate\Database\Eloquent\Collection UserJobTopicSection
 * @property \Illuminate\Database\Eloquent\Collection UserJobTopicU
 * @property \Illuminate\Database\Eloquent\Collection UserJobTopic
 * @property \Illuminate\Database\Eloquent\Collection UserJobU
 * @property \Illuminate\Database\Eloquent\Collection UserJob
 * @property \Illuminate\Database\Eloquent\Collection UserPDTSPAudio
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataC
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataD
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSFileC
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSFileD
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSFileU
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSFile
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSGalerieC
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSGalerieD
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSGalerieU
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSGalery
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSGaleryImageC
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSGaleryImageD
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSGaleryImageU
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSGaleryImage
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSNoteC
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSNoteD
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSNoteU
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSNote
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSP
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSToolC
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSToolD
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSToolFileC
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSToolFileD
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSToolFileU
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSToolFile
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSToolU
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTSTool
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTopicC
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTopicD
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTopicSectionC
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTopicSectionD
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTopicSectionU
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTopicSection
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTopicU
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataTopic
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalDataU
 * @property \Illuminate\Database\Eloquent\Collection UserPersonalData
 * @property \Illuminate\Database\Eloquent\Collection UserProjectC
 * @property \Illuminate\Database\Eloquent\Collection UserProjectD
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSFileC
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSFileD
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSFileU
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSFile
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSGalerieC
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSGalerieD
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSGalerieU
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSGalery
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSGaleryImageC
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSGaleryImageD
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSGaleryImageU
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSGaleryImage
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSNoteC
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSNoteD
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSNoteU
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSNote
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSPAudio
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSPlaylist
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSToolC
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSToolD
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSToolFileC
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSToolFileD
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSToolFileU
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSToolFile
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSToolU
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTSTool
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTopicC
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTopicD
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTopicSectionC
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTopicSectionD
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTopicSectionU
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTopicSection
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTopicU
 * @property \Illuminate\Database\Eloquent\Collection UserProjectTopic
 * @property \Illuminate\Database\Eloquent\Collection UserProjectU
 * @property \Illuminate\Database\Eloquent\Collection UserProject
 * @property string name
 * @property string email
 * @property string password
 * @property string verified_account
 * @property string status
 * @property string remember_token
 */
 
class User extends Model
{
    use SoftDeletes;
    use Billable;

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'email',
        'password',
        'verified_account',
        'status',
        'remember_token'
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'verified_account' => 'string',
        'status' => 'string',
        'remember_token' => 'string'
    ];

    public static $rules = [
        
    ];

    public function calendarEventCreates()
    {
        return $this->hasMany(\App\Models\CalendarEventCreate::class);
    }

    public function calendarEventDeletes()
    {
        return $this->hasMany(\App\Models\CalendarEventDelete::class);
    }

    
    public function calendarEventUpdates()
    {
        return $this->hasMany(\App\Models\CalendarEventUpdate::class);
    }

    
    public function calendarEventViews()
    {
        return $this->hasMany(\App\Models\CalendarEventView::class);
    }

    
    public function calendarEvents()
    {
        return $this->hasMany(\App\Models\CalendarEvent::class);
    }

    
    public function collegeCreates()
    {
        return $this->hasMany(\App\Models\CollegeCreate::class);
    }

    
    public function collegeDeletes()
    {
        return $this->hasMany(\App\Models\CollegeDelete::class);
    }

    
    public function collegeTSFileCreates()
    {
        return $this->hasMany(\App\Models\CollegeTSFileCreate::class);
    }

    
    public function collegeTSFileDeletes()
    {
        return $this->hasMany(\App\Models\CollegeTSFileDelete::class);
    }

    
    public function collegeTSFileTodolistCreates()
    {
        return $this->hasMany(\App\Models\CollegeTSFileTodolistCreate::class);
    }

    
    public function collegeTSFileTodolistDeletes()
    {
        return $this->hasMany(\App\Models\CollegeTSFileTodolistDelete::class);
    }

    
    public function collegeTSFileTodolistUpdates()
    {
        return $this->hasMany(\App\Models\CollegeTSFileTodolistUpdate::class);
    }

    
    public function collegeTSFileTodolistViews()
    {
        return $this->hasMany(\App\Models\CollegeTSFileTodolistView::class);
    }

    
    public function collegeTSFileUpdates()
    {
        return $this->hasMany(\App\Models\CollegeTSFileUpdate::class);
    }

    
    public function collegeTSFileViews()
    {
        return $this->hasMany(\App\Models\CollegeTSFileView::class);
    }

    
    public function collegeTSGImageTodolistCreates()
    {
        return $this->hasMany(\App\Models\CollegeTSGImageTodolistCreate::class);
    }

    
    public function collegeTSGImageTodolistDeletes()
    {
        return $this->hasMany(\App\Models\CollegeTSGImageTodolistDelete::class);
    }

    
    public function collegeTSGImageTodolistUpdates()
    {
        return $this->hasMany(\App\Models\CollegeTSGImageTodolistUpdate::class);
    }

    
    public function collegeTSGImageTodolistViews()
    {
        return $this->hasMany(\App\Models\CollegeTSGImageTodolistView::class);
    }

    
    public function collegeTSGaleryCreates()
    {
        return $this->hasMany(\App\Models\CollegeTSGaleryCreate::class);
    }

    
    public function collegeTSGaleryDeletes()
    {
        return $this->hasMany(\App\Models\CollegeTSGaleryDelete::class);
    }

    
    public function collegeTSGaleryImageCreates()
    {
        return $this->hasMany(\App\Models\CollegeTSGaleryImageCreate::class);
    }

    
    public function collegeTSGaleryImageDeletes()
    {
        return $this->hasMany(\App\Models\CollegeTSGaleryImageDelete::class);
    }

    
    public function collegeTSGaleryImageUpdates()
    {
        return $this->hasMany(\App\Models\CollegeTSGaleryImageUpdate::class);
    }

    
    public function collegeTSGaleryImageViews()
    {
        return $this->hasMany(\App\Models\CollegeTSGaleryImageView::class);
    }

    
    public function collegeTSGaleryTodolistCreates()
    {
        return $this->hasMany(\App\Models\CollegeTSGaleryTodolistCreate::class);
    }

    
    public function collegeTSGaleryTodolistDeletes()
    {
        return $this->hasMany(\App\Models\CollegeTSGaleryTodolistDelete::class);
    }

    
    public function collegeTSGaleryTodolistUpdates()
    {
        return $this->hasMany(\App\Models\CollegeTSGaleryTodolistUpdate::class);
    }

    
    public function collegeTSGaleryTodolistViews()
    {
        return $this->hasMany(\App\Models\CollegeTSGaleryTodolistView::class);
    }

    
    public function collegeTSGaleryUpdates()
    {
        return $this->hasMany(\App\Models\CollegeTSGaleryUpdate::class);
    }

    
    public function collegeTSGaleryViews()
    {
        return $this->hasMany(\App\Models\CollegeTSGaleryView::class);
    }

    
    public function collegeTSNoteCreates()
    {
        return $this->hasMany(\App\Models\CollegeTSNoteCreate::class);
    }

    
    public function collegeTSNoteDeletes()
    {
        return $this->hasMany(\App\Models\CollegeTSNoteDelete::class);
    }

    
    public function collegeTSNoteTodolistCreates()
    {
        return $this->hasMany(\App\Models\CollegeTSNoteTodolistCreate::class);
    }

    
    public function collegeTSNoteTodolistDeletes()
    {
        return $this->hasMany(\App\Models\CollegeTSNoteTodolistDelete::class);
    }

    
    public function collegeTSNoteTodolistUpdates()
    {
        return $this->hasMany(\App\Models\CollegeTSNoteTodolistUpdate::class);
    }

    
    public function collegeTSNoteTodolistViews()
    {
        return $this->hasMany(\App\Models\CollegeTSNoteTodolistView::class);
    }

    
    public function collegeTSNoteUpdates()
    {
        return $this->hasMany(\App\Models\CollegeTSNoteUpdate::class);
    }

    
    public function collegeTSNoteViews()
    {
        return $this->hasMany(\App\Models\CollegeTSNoteView::class);
    }

    
    public function collegeTSPAudioCreates()
    {
        return $this->hasMany(\App\Models\CollegeTSPAudioCreate::class);
    }

    
    public function collegeTSPAudioDeletes()
    {
        return $this->hasMany(\App\Models\CollegeTSPAudioDelete::class);
    }

    
    public function collegeTSPAudioUpdates()
    {
        return $this->hasMany(\App\Models\CollegeTSPAudioUpdate::class);
    }

    
    public function collegeTSPAudioViews()
    {
        return $this->hasMany(\App\Models\CollegeTSPAudioView::class);
    }

    
    public function collegeTSPTCreates()
    {
        return $this->hasMany(\App\Models\CollegeTSPTCreate::class);
    }

    
    public function collegeTSPTDeletes()
    {
        return $this->hasMany(\App\Models\CollegeTSPTDelete::class);
    }

    
    public function collegeTSPTUpdates()
    {
        return $this->hasMany(\App\Models\CollegeTSPTUpdate::class);
    }

    
    public function collegeTSPTViews()
    {
        return $this->hasMany(\App\Models\CollegeTSPTView::class);
    }

    
    public function collegeTSToolCreates()
    {
        return $this->hasMany(\App\Models\CollegeTSToolCreate::class);
    }

    
    public function collegeTSToolDeletes()
    {
        return $this->hasMany(\App\Models\CollegeTSToolDelete::class);
    }

    
    public function collegeTSToolFileCreates()
    {
        return $this->hasMany(\App\Models\CollegeTSToolFileCreate::class);
    }

    
    public function collegeTSToolFileDeletes()
    {
        return $this->hasMany(\App\Models\CollegeTSToolFileDelete::class);
    }

    
    public function collegeTSToolFileTodolistCreates()
    {
        return $this->hasMany(\App\Models\CollegeTSToolFileTodolistCreate::class);
    }

    
    public function collegeTSToolFileTodolistDeletes()
    {
        return $this->hasMany(\App\Models\CollegeTSToolFileTodolistDelete::class);
    }

    
    public function collegeTSToolFileTodolistUpdates()
    {
        return $this->hasMany(\App\Models\CollegeTSToolFileTodolistUpdate::class);
    }

    
    public function collegeTSToolFileTodolistViews()
    {
        return $this->hasMany(\App\Models\CollegeTSToolFileTodolistView::class);
    }

    
    public function collegeTSToolFileUpdates()
    {
        return $this->hasMany(\App\Models\CollegeTSToolFileUpdate::class);
    }

    
    public function collegeTSToolFileViews()
    {
        return $this->hasMany(\App\Models\CollegeTSToolFileView::class);
    }

    
    public function collegeTSToolTodolistCreates()
    {
        return $this->hasMany(\App\Models\CollegeTSToolTodolistCreate::class);
    }

    
    public function collegeTSToolTodolistDeletes()
    {
        return $this->hasMany(\App\Models\CollegeTSToolTodolistDelete::class);
    }

    
    public function collegeTSToolTodolistUpdates()
    {
        return $this->hasMany(\App\Models\CollegeTSToolTodolistUpdate::class);
    }

    
    public function collegeTSToolTodolistViews()
    {
        return $this->hasMany(\App\Models\CollegeTSToolTodolistView::class);
    }

    
    public function collegeTSToolUpdates()
    {
        return $this->hasMany(\App\Models\CollegeTSToolUpdate::class);
    }

    
    public function collegeTSToolViews()
    {
        return $this->hasMany(\App\Models\CollegeTSToolView::class);
    }

    
    public function collegeTodolistCreates()
    {
        return $this->hasMany(\App\Models\CollegeTodolistCreate::class);
    }

    
    public function collegeTodolistDeletes()
    {
        return $this->hasMany(\App\Models\CollegeTodolistDelete::class);
    }

    
    public function collegeTodolistUpdates()
    {
        return $this->hasMany(\App\Models\CollegeTodolistUpdate::class);
    }

    
    public function collegeTodolistViews()
    {
        return $this->hasMany(\App\Models\CollegeTodolistView::class);
    }

    
    public function collegeTopicCreates()
    {
        return $this->hasMany(\App\Models\CollegeTopicCreate::class);
    }

    
    public function collegeTopicDeletes()
    {
        return $this->hasMany(\App\Models\CollegeTopicDelete::class);
    }

    
    public function collegeTopicSectionCreates()
    {
        return $this->hasMany(\App\Models\CollegeTopicSectionCreate::class);
    }

    
    public function collegeTopicSectionDeletes()
    {
        return $this->hasMany(\App\Models\CollegeTopicSectionDelete::class);
    }

    
    public function collegeTopicSectionTodolistCreates()
    {
        return $this->hasMany(\App\Models\CollegeTopicSectionTodolistCreate::class);
    }

    
    public function collegeTopicSectionTodolistDeletes()
    {
        return $this->hasMany(\App\Models\CollegeTopicSectionTodolistDelete::class);
    }

    
    public function collegeTopicSectionTodolistUpdates()
    {
        return $this->hasMany(\App\Models\CollegeTopicSectionTodolistUpdate::class);
    }

    
    public function collegeTopicSectionTodolistViews()
    {
        return $this->hasMany(\App\Models\CollegeTopicSectionTodolistView::class);
    }

    
    public function collegeTopicSectionUpdates()
    {
        return $this->hasMany(\App\Models\CollegeTopicSectionUpdate::class);
    }

    
    public function collegeTopicSectionViews()
    {
        return $this->hasMany(\App\Models\CollegeTopicSectionView::class);
    }

    
    public function collegeTopicTodolistCreates()
    {
        return $this->hasMany(\App\Models\CollegeTopicTodolistCreate::class);
    }

    
    public function collegeTopicTodolistDeletes()
    {
        return $this->hasMany(\App\Models\CollegeTopicTodolistDelete::class);
    }

    
    public function collegeTopicTodolistUpdates()
    {
        return $this->hasMany(\App\Models\CollegeTopicTodolistUpdate::class);
    }

    
    public function collegeTopicTodolistViews()
    {
        return $this->hasMany(\App\Models\CollegeTopicTodolistView::class);
    }

    
    public function collegeTopicUpdates()
    {
        return $this->hasMany(\App\Models\CollegeTopicUpdate::class);
    }

    
    public function collegeTopicViews()
    {
        return $this->hasMany(\App\Models\CollegeTopicView::class);
    }

    
    public function collegeUpdates()
    {
        return $this->hasMany(\App\Models\CollegeUpdate::class);
    }

    
    public function collegeViews()
    {
        return $this->hasMany(\App\Models\CollegeView::class);
    }

    
    public function colleges()
    {
        return $this->hasMany(\App\Models\College::class);
    }

    
    public function contactAddressCreates()
    {
        return $this->hasMany(\App\Models\ContactAddressCreate::class);
    }

    
    public function contactAddressDeletes()
    {
        return $this->hasMany(\App\Models\ContactAddressDelete::class);
    }

    
    public function contactAddressUpdates()
    {
        return $this->hasMany(\App\Models\ContactAddressUpdate::class);
    }

    
    public function contactAddressViews()
    {
        return $this->hasMany(\App\Models\ContactAddressView::class);
    }

    
    public function contactCreates()
    {
        return $this->hasMany(\App\Models\ContactCreate::class);
    }

    
    public function contactDeletes()
    {
        return $this->hasMany(\App\Models\ContactDelete::class);
    }

    
    public function contactEmailCreates()
    {
        return $this->hasMany(\App\Models\ContactEmailCreate::class);
    }

    
    public function contactEmailDeletes()
    {
        return $this->hasMany(\App\Models\ContactEmailDelete::class);
    }

    
    public function contactEmailUpdates()
    {
        return $this->hasMany(\App\Models\ContactEmailUpdate::class);
    }

    
    public function contactEmailViews()
    {
        return $this->hasMany(\App\Models\ContactEmailView::class);
    }

    
    public function contactSocialCreates()
    {
        return $this->hasMany(\App\Models\ContactSocialCreate::class);
    }

    
    public function contactSocialDeletes()
    {
        return $this->hasMany(\App\Models\ContactSocialDelete::class);
    }

    
    public function contactSocialUpdates()
    {
        return $this->hasMany(\App\Models\ContactSocialUpdate::class);
    }

    
    public function contactSocialViews()
    {
        return $this->hasMany(\App\Models\ContactSocialView::class);
    }

    
    public function contactTelephoneCreates()
    {
        return $this->hasMany(\App\Models\ContactTelephoneCreate::class);
    }

    
    public function contactTelephoneDeletes()
    {
        return $this->hasMany(\App\Models\ContactTelephoneDelete::class);
    }

    
    public function contactTelephoneUpdates()
    {
        return $this->hasMany(\App\Models\ContactTelephoneUpdate::class);
    }

    
    public function contactTelephoneViews()
    {
        return $this->hasMany(\App\Models\ContactTelephoneView::class);
    }

    
    public function contactUpdates()
    {
        return $this->hasMany(\App\Models\ContactUpdate::class);
    }

    
    public function contactViews()
    {
        return $this->hasMany(\App\Models\ContactView::class);
    }

    
    public function contactWebCreates()
    {
        return $this->hasMany(\App\Models\ContactWebCreate::class);
    }

    
    public function contactWebDeletes()
    {
        return $this->hasMany(\App\Models\ContactWebDelete::class);
    }

    
    public function contactWebUpdates()
    {
        return $this->hasMany(\App\Models\ContactWebUpdate::class);
    }

    
    public function contactWebViews()
    {
        return $this->hasMany(\App\Models\ContactWebView::class);
    }

    
    public function contacts()
    {
        return $this->hasMany(\App\Models\Contact::class);
    }

    
    public function jobCreates()
    {
        return $this->hasMany(\App\Models\JobCreate::class);
    }

    
    public function jobDeletes()
    {
        return $this->hasMany(\App\Models\JobDelete::class);
    }

    
    public function jobTSFileCreates()
    {
        return $this->hasMany(\App\Models\JobTSFileCreate::class);
    }

    
    public function jobTSFileDeletes()
    {
        return $this->hasMany(\App\Models\JobTSFileDelete::class);
    }

    
    public function jobTSFileTodolistCreates()
    {
        return $this->hasMany(\App\Models\JobTSFileTodolistCreate::class);
    }

    
    public function jobTSFileTodolistDeletes()
    {
        return $this->hasMany(\App\Models\JobTSFileTodolistDelete::class);
    }

    
    public function jobTSFileTodolistUpdates()
    {
        return $this->hasMany(\App\Models\JobTSFileTodolistUpdate::class);
    }

    
    public function jobTSFileTodolistViews()
    {
        return $this->hasMany(\App\Models\JobTSFileTodolistView::class);
    }

    
    public function jobTSFileUpdates()
    {
        return $this->hasMany(\App\Models\JobTSFileUpdate::class);
    }

    
    public function jobTSFileViews()
    {
        return $this->hasMany(\App\Models\JobTSFileView::class);
    }

    
    public function jobTSGImageTodolistCreates()
    {
        return $this->hasMany(\App\Models\JobTSGImageTodolistCreate::class);
    }

    
    public function jobTSGImageTodolistDeletes()
    {
        return $this->hasMany(\App\Models\JobTSGImageTodolistDelete::class);
    }

    
    public function jobTSGImageTodolistUpdates()
    {
        return $this->hasMany(\App\Models\JobTSGImageTodolistUpdate::class);
    }

    
    public function jobTSGImageTodolistViews()
    {
        return $this->hasMany(\App\Models\JobTSGImageTodolistView::class);
    }

    
    public function jobTSGaleryCreates()
    {
        return $this->hasMany(\App\Models\JobTSGaleryCreate::class);
    }

    
    public function jobTSGaleryDeletes()
    {
        return $this->hasMany(\App\Models\JobTSGaleryDelete::class);
    }

    
    public function jobTSGaleryImageCreates()
    {
        return $this->hasMany(\App\Models\JobTSGaleryImageCreates::class);
    }

    
    public function jobTSGaleryImageDeletes()
    {
        return $this->hasMany(\App\Models\JobTSGaleryImageDelete::class);
    }

    
    public function jobTSGaleryImageUpdates()
    {
        return $this->hasMany(\App\Models\JobTSGaleryImageUpdates::class);
    }

    
    public function jobTSGaleryImageViews()
    {
        return $this->hasMany(\App\Models\JobTSGaleryImageViews::class);
    }

    
    public function jobTSGaleryTodolistCreates()
    {
        return $this->hasMany(\App\Models\JobTSGaleryTodolistCreate::class);
    }

    
    public function jobTSGaleryTodolistDeletes()
    {
        return $this->hasMany(\App\Models\JobTSGaleryTodolistDelete::class);
    }

    
    public function jobTSGaleryTodolistUpdates()
    {
        return $this->hasMany(\App\Models\JobTSGaleryTodolistUpdate::class);
    }

    
    public function jobTSGaleryTodolistViews()
    {
        return $this->hasMany(\App\Models\JobTSGaleryTodolistView::class);
    }

    
    public function jobTSGaleryUpdates()
    {
        return $this->hasMany(\App\Models\JobTSGaleryUpdate::class);
    }

    
    public function jobTSGaleryViews()
    {
        return $this->hasMany(\App\Models\JobTSGaleryView::class);
    }

    
    public function jobTSNoteCreates()
    {
        return $this->hasMany(\App\Models\JobTSNoteCreate::class);
    }

    
    public function jobTSNoteDeletes()
    {
        return $this->hasMany(\App\Models\JobTSNoteDelete::class);
    }

    
    public function jobTSNoteTodolistCreates()
    {
        return $this->hasMany(\App\Models\JobTSNoteTodolistCreate::class);
    }

    
    public function jobTSNoteTodolistDeletes()
    {
        return $this->hasMany(\App\Models\JobTSNoteTodolistDelete::class);
    }

    
    public function jobTSNoteTodolistUpdates()
    {
        return $this->hasMany(\App\Models\JobTSNoteTodolistUpdate::class);
    }

    
    public function jobTSNoteTodolistViews()
    {
        return $this->hasMany(\App\Models\JobTSNoteTodolistView::class);
    }

    
    public function jobTSNoteUpdates()
    {
        return $this->hasMany(\App\Models\JobTSNoteUpdate::class);
    }

    
    public function jobTSNoteViews()
    {
        return $this->hasMany(\App\Models\JobTSNoteView::class);
    }

    
    public function jobTSPAudioCreates()
    {
        return $this->hasMany(\App\Models\JobTSPAudioCreate::class);
    }

    
    public function jobTSPAudioDeletes()
    {
        return $this->hasMany(\App\Models\JobTSPAudioDelete::class);
    }

    
    public function jobTSPAudioUpdates()
    {
        return $this->hasMany(\App\Models\JobTSPAudioUpdate::class);
    }

    
    public function jobTSPAudioViews()
    {
        return $this->hasMany(\App\Models\JobTSPAudioView::class);
    }

    
    public function jobTSPTCreates()
    {
        return $this->hasMany(\App\Models\JobTSPTCreate::class);
    }

    
    public function jobTSPTDeletes()
    {
        return $this->hasMany(\App\Models\JobTSPTDelete::class);
    }

    
    public function jobTSPTUpdates()
    {
        return $this->hasMany(\App\Models\JobTSPTUpdate::class);
    }

    
    public function jobTSPTViews()
    {
        return $this->hasMany(\App\Models\JobTSPTView::class);
    }

    
    public function jobTSToolCreates()
    {
        return $this->hasMany(\App\Models\JobTSToolCreate::class);
    }

    
    public function jobTSToolDeletes()
    {
        return $this->hasMany(\App\Models\JobTSToolDelete::class);
    }

    
    public function jobTSToolFileCreates()
    {
        return $this->hasMany(\App\Models\JobTSToolFileCreate::class);
    }

    
    public function jobTSToolFileDeletes()
    {
        return $this->hasMany(\App\Models\JobTSToolFileDelete::class);
    }

    
    public function jobTSToolFileTodolistCreates()
    {
        return $this->hasMany(\App\Models\JobTSToolFileTodolistCreate::class);
    }

    
    public function jobTSToolFileTodolistDeletes()
    {
        return $this->hasMany(\App\Models\JobTSToolFileTodolistDelete::class);
    }

    
    public function jobTSToolFileTodolistUpdates()
    {
        return $this->hasMany(\App\Models\JobTSToolFileTodolistUpdate::class);
    }

    
    public function jobTSToolFileTodolistViews()
    {
        return $this->hasMany(\App\Models\JobTSToolFileTodolistView::class);
    }

    
    public function jobTSToolFileUpdates()
    {
        return $this->hasMany(\App\Models\JobTSToolFileUpdate::class);
    }

    
    public function jobTSToolFileViews()
    {
        return $this->hasMany(\App\Models\JobTSToolFileView::class);
    }

    
    public function jobTSToolTodolistCreates()
    {
        return $this->hasMany(\App\Models\JobTSToolTodolistCreate::class);
    }

    
    public function jobTSToolTodolistDeletes()
    {
        return $this->hasMany(\App\Models\JobTSToolTodolistDelete::class);
    }

    
    public function jobTSToolTodolistUpdates()
    {
        return $this->hasMany(\App\Models\JobTSToolTodolistUpdate::class);
    }

    
    public function jobTSToolTodolistViews()
    {
        return $this->hasMany(\App\Models\JobTSToolTodolistView::class);
    }

    
    public function jobTSToolUpdates()
    {
        return $this->hasMany(\App\Models\JobTSToolUpdate::class);
    }

    
    public function jobTSToolViews()
    {
        return $this->hasMany(\App\Models\JobTSToolView::class);
    }

    
    public function jobTodolistCreates()
    {
        return $this->hasMany(\App\Models\JobTodolistCreate::class);
    }

    
    public function jobTodolistDeletes()
    {
        return $this->hasMany(\App\Models\JobTodolistDelete::class);
    }

    
    public function jobTodolistUpdates()
    {
        return $this->hasMany(\App\Models\JobTodolistUpdate::class);
    }

    
    public function jobTodolistViews()
    {
        return $this->hasMany(\App\Models\JobTodolistView::class);
    }

    
    public function jobTopicCreates()
    {
        return $this->hasMany(\App\Models\JobTopicCreate::class);
    }

    
    public function jobTopicDeletes()
    {
        return $this->hasMany(\App\Models\JobTopicDelete::class);
    }

    
    public function jobTopicSectionCreates()
    {
        return $this->hasMany(\App\Models\JobTopicSectionCreate::class);
    }

    
    public function jobTopicSectionDeletes()
    {
        return $this->hasMany(\App\Models\JobTopicSectionDelete::class);
    }

    
    public function jobTopicSectionTodolistCreates()
    {
        return $this->hasMany(\App\Models\JobTopicSectionTodolistCreate::class);
    }

    
    public function jobTopicSectionTodolistDeletes()
    {
        return $this->hasMany(\App\Models\JobTopicSectionTodolistDelete::class);
    }

    
    public function jobTopicSectionTodolistUpdates()
    {
        return $this->hasMany(\App\Models\JobTopicSectionTodolistUpdate::class);
    }

    
    public function jobTopicSectionTodolistViews()
    {
        return $this->hasMany(\App\Models\JobTopicSectionTodolistView::class);
    }

    
    public function jobTopicSectionUpdates()
    {
        return $this->hasMany(\App\Models\JobTopicSectionUpdate::class);
    }

    
    public function jobTopicSectionViews()
    {
        return $this->hasMany(\App\Models\JobTopicSectionView::class);
    }

    
    public function jobTopicTodolistCreates()
    {
        return $this->hasMany(\App\Models\JobTopicTodolistCreate::class);
    }

    
    public function jobTopicTodolistDeletes()
    {
        return $this->hasMany(\App\Models\JobTopicTodolistDelete::class);
    }

    
    public function jobTopicTodolistUpdates()
    {
        return $this->hasMany(\App\Models\JobTopicTodolistUpdate::class);
    }

    
    public function jobTopicTodolistViews()
    {
        return $this->hasMany(\App\Models\JobTopicTodolistView::class);
    }

    
    public function jobTopicUpdates()
    {
        return $this->hasMany(\App\Models\JobTopicUpdate::class);
    }

    
    public function jobTopicViews()
    {
        return $this->hasMany(\App\Models\JobTopicView::class);
    }

    
    public function jobUpdates()
    {
        return $this->hasMany(\App\Models\JobUpdate::class);
    }

    
    public function jobViews()
    {
        return $this->hasMany(\App\Models\JobView::class);
    }

    
    public function jobs()
    {
        return $this->hasMany(\App\Models\Job::class);
    }

    
    public function messageCreates()
    {
        return $this->hasMany(\App\Models\MessageCreate::class);
    }

    
    public function messageDeletes()
    {
        return $this->hasMany(\App\Models\MessageDelete::class);
    }

    
    public function messageViews()
    {
        return $this->hasMany(\App\Models\MessageView::class);
    }

    
    public function messages()
    {
        return $this->hasMany(\App\Models\Message::class);
    }

    
    public function pDTSPAudioCreates()
    {
        return $this->hasMany(\App\Models\PDTSPAudioCreate::class);
    }

    
    public function pDTSPAudioDeletes()
    {
        return $this->hasMany(\App\Models\PDTSPAudioDelete::class);
    }

    
    public function pDTSPAudioUpdates()
    {
        return $this->hasMany(\App\Models\PDTSPAudioUpdate::class);
    }

    
    public function pDTSPAudioViews()
    {
        return $this->hasMany(\App\Models\PDTSPAudioView::class);
    }

    
    public function personalDataCreates()
    {
        return $this->hasMany(\App\Models\PersonalDataCreate::class);
    }

    
    public function personalDataDeletes()
    {
        return $this->hasMany(\App\Models\PersonalDataDelete::class);
    }

    
    public function personalDataTSFTodolistCreates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSFTodolistCreate::class);
    }

    
    public function personalDataTSFTodolistDeletes()
    {
        return $this->hasMany(\App\Models\PersonalDataTSFTodolistDelete::class);
    }

    
    public function personalDataTSFTodolistUpdates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSFTodolistUpdate::class);
    }

    
    public function personalDataTSFTodolistViews()
    {
        return $this->hasMany(\App\Models\PersonalDataTSFTodolistView::class);
    }

    
    public function personalDataTSFileCreates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSFileCreate::class);
    }

    
    public function personalDataTSFileDeletes()
    {
        return $this->hasMany(\App\Models\PersonalDataTSFileDelete::class);
    }

    
    public function personalDataTSFileUpdates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSFileUpdate::class);
    }

    
    public function personalDataTSFileViews()
    {
        return $this->hasMany(\App\Models\PersonalDataTSFileView::class);
    }

    
    public function personalDataTSGITodolistCreates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSGITodolistCreate::class);
    }

    
    public function personalDataTSGITodolistDeletes()
    {
        return $this->hasMany(\App\Models\PersonalDataTSGITodolistDelete::class);
    }

    
    public function personalDataTSGITodolistUpdates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSGITodolistUpdate::class);
    }

    
    public function personalDataTSGITodolistViews()
    {
        return $this->hasMany(\App\Models\PersonalDataTSGITodolistView::class);
    }

    
    public function personalDataTSGTodolistCreates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSGTodolistCreate::class);
    }

    
    public function personalDataTSGTodolistDeletes()
    {
        return $this->hasMany(\App\Models\PersonalDataTSGTodolistDelete::class);
    }

    
    public function personalDataTSGTodolistUpdates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSGTodolistUpdate::class);
    }

    
    public function personalDataTSGTodolistViews()
    {
        return $this->hasMany(\App\Models\PersonalDataTSGTodolistView::class);
    }

    
    public function personalDataTSGaleryCreates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSGaleryCreate::class);
    }

    
    public function personalDataTSGaleryDeletes()
    {
        return $this->hasMany(\App\Models\PersonalDataTSGaleryDelete::class);
    }

    
    public function personalDataTSGaleryImageCreates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSGaleryImageCreate::class);
    }

    
    public function personalDataTSGaleryImageDeletes()
    {
        return $this->hasMany(\App\Models\PersonalDataTSGaleryImageDelete::class);
    }

    
    public function personalDataTSGaleryImageUpdates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSGaleryImageUpdate::class);
    }

    
    public function personalDataTSGaleryImageViews()
    {
        return $this->hasMany(\App\Models\PersonalDataTSGaleryImageView::class);
    }

    
    public function personalDataTSGaleryUpdates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSGaleryUpdate::class);
    }

    
    public function personalDataTSGaleryViews()
    {
        return $this->hasMany(\App\Models\PersonalDataTSGaleryView::class);
    }

    
    public function personalDataTSNTodolistCreates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSNTodolistCreate::class);
    }

    
    public function personalDataTSNTodolistDeletes()
    {
        return $this->hasMany(\App\Models\PersonalDataTSNTodolistDelete::class);
    }

    
    public function personalDataTSNTodolistUpdates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSNTodolistUpdate::class);
    }

    
    public function personalDataTSNTodolistViews()
    {
        return $this->hasMany(\App\Models\PersonalDataTSNTodolistView::class);
    }

    
    public function personalDataTSNoteCreates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSNoteCreate::class);
    }

    
    public function personalDataTSNoteDeletes()
    {
        return $this->hasMany(\App\Models\PersonalDataTSNoteDelete::class);
    }

    
    public function personalDataTSNoteUpdates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSNoteUpdate::class);
    }

    
    public function personalDataTSNoteViews()
    {
        return $this->hasMany(\App\Models\PersonalDataTSNoteView::class);
    }

    
    public function personalDataTSPTCreates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSPTCreate::class);
    }

    
    public function personalDataTSPTDeletes()
    {
        return $this->hasMany(\App\Models\PersonalDataTSPTDelete::class);
    }

    
    public function personalDataTSPTUpdates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSPTUpdate::class);
    }

    
    public function personalDataTSPTViews()
    {
        return $this->hasMany(\App\Models\PersonalDataTSPTView::class);
    }

    
    public function personalDataTSTFTodolistCreates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSTFTodolistCreate::class);
    }

    
    public function personalDataTSTFTodolistDeletes()
    {
        return $this->hasMany(\App\Models\PersonalDataTSTFTodolistDelete::class);
    }

    
    public function personalDataTSTFTodolistUpdates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSTFTodolistUpdate::class);
    }

    
    public function personalDataTSTFTodolistViews()
    {
        return $this->hasMany(\App\Models\PersonalDataTSTFTodolistView::class);
    }

    
    public function personalDataTSTTodolistCreates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSTTodolistCreate::class);
    }

    
    public function personalDataTSTTodolistDeletes()
    {
        return $this->hasMany(\App\Models\PersonalDataTSTTodolistDelete::class);
    }

    
    public function personalDataTSTTodolistUpdates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSTTodolistUpdate::class);
    }

    
    public function personalDataTSTTodolistViews()
    {
        return $this->hasMany(\App\Models\PersonalDataTSTTodolistView::class);
    }

    
    public function personalDataTSTodolistCreates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSTodolistCreate::class);
    }

    
    public function personalDataTSTodolistDeletes()
    {
        return $this->hasMany(\App\Models\PersonalDataTSTodolistDelete::class);
    }

    
    public function personalDataTSTodolistUpdates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSTodolistUpdate::class);
    }

    
    public function personalDataTSTodolistViews()
    {
        return $this->hasMany(\App\Models\PersonalDataTSTodolistView::class);
    }

    
    public function personalDataTSToolCreates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSToolCreate::class);
    }

    
    public function personalDataTSToolDeletes()
    {
        return $this->hasMany(\App\Models\PersonalDataTSToolDelete::class);
    }

    
    public function personalDataTSToolFileCreates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSToolFileCreate::class);
    }

    
    public function personalDataTSToolFileDeletes()
    {
        return $this->hasMany(\App\Models\PersonalDataTSToolFileDelete::class);
    }

    
    public function personalDataTSToolFileUpdates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSToolFileUpdate::class);
    }

    
    public function personalDataTSToolFileViews()
    {
        return $this->hasMany(\App\Models\PersonalDataTSToolFileView::class);
    }

    
    public function personalDataTSToolUpdates()
    {
        return $this->hasMany(\App\Models\PersonalDataTSToolUpdate::class);
    }

    
    public function personalDataTSToolViews()
    {
        return $this->hasMany(\App\Models\PersonalDataTSToolView::class);
    }

    
    public function personalDataTodolistCreates()
    {
        return $this->hasMany(\App\Models\PersonalDataTodolistCreate::class);
    }

    
    public function personalDataTodolistDeletes()
    {
        return $this->hasMany(\App\Models\PersonalDataTodolistDelete::class);
    }

    
    public function personalDataTodolistUpdates()
    {
        return $this->hasMany(\App\Models\PersonalDataTodolistUpdate::class);
    }

    
    public function personalDataTodolistViews()
    {
        return $this->hasMany(\App\Models\PersonalDataTodolistView::class);
    }

    
    public function personalDataTopicCreates()
    {
        return $this->hasMany(\App\Models\PersonalDataTopicCreate::class);
    }

    
    public function personalDataTopicDeletes()
    {
        return $this->hasMany(\App\Models\PersonalDataTopicDelete::class);
    }

    
    public function personalDataTopicSectionCreates()
    {
        return $this->hasMany(\App\Models\PersonalDataTopicSectionCreate::class);
    }

    
    public function personalDataTopicSectionDeletes()
    {
        return $this->hasMany(\App\Models\PersonalDataTopicSectionDelete::class);
    }

    
    public function personalDataTopicSectionUpdates()
    {
        return $this->hasMany(\App\Models\PersonalDataTopicSectionUpdate::class);
    }

    
    public function personalDataTopicSectionViews()
    {
        return $this->hasMany(\App\Models\PersonalDataTopicSectionView::class);
    }

    
    public function personalDataTopicTodolistCreates()
    {
        return $this->hasMany(\App\Models\PersonalDataTopicTodolistCreate::class);
    }

    
    public function personalDataTopicTodolistDeletes()
    {
        return $this->hasMany(\App\Models\PersonalDataTopicTodolistDelete::class);
    }

    
    public function personalDataTopicTodolistUpdates()
    {
        return $this->hasMany(\App\Models\PersonalDataTopicTodolistUpdate::class);
    }

    
    public function personalDataTopicTodolistViews()
    {
        return $this->hasMany(\App\Models\PersonalDataTopicTodolistView::class);
    }

    
    public function personalDataTopicUpdates()
    {
        return $this->hasMany(\App\Models\PersonalDataTopicUpdate::class);
    }

    
    public function personalDataTopicViews()
    {
        return $this->hasMany(\App\Models\PersonalDataTopicView::class);
    }

    
    public function personalDataUpdates()
    {
        return $this->hasMany(\App\Models\PersonalDataUpdate::class);
    }

    
    public function personalDataViews()
    {
        return $this->hasMany(\App\Models\PersonalDataView::class);
    }

    
    public function personalDatas()
    {
        return $this->hasMany(\App\Models\PersonalData::class);
    }

    
    public function projectCreates()
    {
        return $this->hasMany(\App\Models\ProjectCreate::class);
    }

    
    public function projectDeletes()
    {
        return $this->hasMany(\App\Models\ProjectDelete::class);
    }

    
    public function projectTSFileCreates()
    {
        return $this->hasMany(\App\Models\ProjectTSFileCreate::class);
    }

    
    public function projectTSFileDeletes()
    {
        return $this->hasMany(\App\Models\ProjectTSFileDelete::class);
    }

    
    public function projectTSFileTodolistCreates()
    {
        return $this->hasMany(\App\Models\ProjectTSFileTodolistCreate::class);
    }

    
    public function projectTSFileTodolistDeletes()
    {
        return $this->hasMany(\App\Models\ProjectTSFileTodolistDelete::class);
    }

    
    public function projectTSFileTodolistUpdates()
    {
        return $this->hasMany(\App\Models\ProjectTSFileTodolistUpdate::class);
    }

    
    public function projectTSFileTodolistViews()
    {
        return $this->hasMany(\App\Models\ProjectTSFileTodolistView::class);
    }

    
    public function projectTSFileUpdates()
    {
        return $this->hasMany(\App\Models\ProjectTSFileUpdate::class);
    }

    
    public function projectTSFileViews()
    {
        return $this->hasMany(\App\Models\ProjectTSFileView::class);
    }

    
    public function projectTSGImageTodolistCreates()
    {
        return $this->hasMany(\App\Models\ProjectTSGImageTodolistCreate::class);
    }

    
    public function projectTSGImageTodolistDeletes()
    {
        return $this->hasMany(\App\Models\ProjectTSGImageTodolistDelete::class);
    }

    
    public function projectTSGImageTodolistUpdates()
    {
        return $this->hasMany(\App\Models\ProjectTSGImageTodolistUpdate::class);
    }

    
    public function projectTSGImageTodolistViews()
    {
        return $this->hasMany(\App\Models\ProjectTSGImageTodolistView::class);
    }

    
    public function projectTSGaleryCreates()
    {
        return $this->hasMany(\App\Models\ProjectTSGaleryCreate::class);
    }

    
    public function projectTSGaleryDeletes()
    {
        return $this->hasMany(\App\Models\ProjectTSGaleryDelete::class);
    }

    
    public function projectTSGaleryImageCreates()
    {
        return $this->hasMany(\App\Models\ProjectTSGaleryImageCreate::class);
    }

    
    public function projectTSGaleryImageDeletes()
    {
        return $this->hasMany(\App\Models\ProjectTSGaleryImageDelete::class);
    }

    
    public function projectTSGaleryImageUpdates()
    {
        return $this->hasMany(\App\Models\ProjectTSGaleryImageUpdate::class);
    }

    
    public function projectTSGaleryImageViews()
    {
        return $this->hasMany(\App\Models\ProjectTSGaleryImageView::class);
    }

    
    public function projectTSGaleryTodolistCreates()
    {
        return $this->hasMany(\App\Models\ProjectTSGaleryTodolistCreate::class);
    }

    
    public function projectTSGaleryTodolistDeletes()
    {
        return $this->hasMany(\App\Models\ProjectTSGaleryTodolistDelete::class);
    }

    
    public function projectTSGaleryTodolistUpdates()
    {
        return $this->hasMany(\App\Models\ProjectTSGaleryTodolistUpdate::class);
    }

    
    public function projectTSGaleryTodolistViews()
    {
        return $this->hasMany(\App\Models\ProjectTSGaleryTodolistView::class);
    }

    
    public function projectTSGaleryUpdates()
    {
        return $this->hasMany(\App\Models\ProjectTSGaleryUpdate::class);
    }

    
    public function projectTSGaleryViews()
    {
        return $this->hasMany(\App\Models\ProjectTSGaleryView::class);
    }

    
    public function projectTSNoteCreates()
    {
        return $this->hasMany(\App\Models\ProjectTSNoteCreate::class);
    }

    
    public function projectTSNoteDeletes()
    {
        return $this->hasMany(\App\Models\ProjectTSNoteDelete::class);
    }

    
    public function projectTSNoteTodolistCreates()
    {
        return $this->hasMany(\App\Models\ProjectTSNoteTodolistCreate::class);
    }

    
    public function projectTSNoteTodolistDeletes()
    {
        return $this->hasMany(\App\Models\ProjectTSNoteTodolistDelete::class);
    }

    
    public function projectTSNoteTodolistUpdates()
    {
        return $this->hasMany(\App\Models\ProjectTSNoteTodolistUpdate::class);
    }

    
    public function projectTSNoteTodolistViews()
    {
        return $this->hasMany(\App\Models\ProjectTSNoteTodolistView::class);
    }

    
    public function projectTSNoteUpdates()
    {
        return $this->hasMany(\App\Models\ProjectTSNoteUpdate::class);
    }

    
    public function projectTSNoteViews()
    {
        return $this->hasMany(\App\Models\ProjectTSNoteView::class);
    }

    
    public function projectTSPAudioCreates()
    {
        return $this->hasMany(\App\Models\ProjectTSPAudioCreate::class);
    }

    
    public function projectTSPAudioDeletes()
    {
        return $this->hasMany(\App\Models\ProjectTSPAudioDelete::class);
    }

    
    public function projectTSPAudioUpdates()
    {
        return $this->hasMany(\App\Models\ProjectTSPAudioUpdate::class);
    }

    
    public function projectTSPAudioViews()
    {
        return $this->hasMany(\App\Models\ProjectTSPAudioView::class);
    }

    
    public function projectTSPTCreates()
    {
        return $this->hasMany(\App\Models\ProjectTSPTCreate::class);
    }

    
    public function projectTSPTDeletes()
    {
        return $this->hasMany(\App\Models\ProjectTSPTDelete::class);
    }

    
    public function projectTSPTUpdates()
    {
        return $this->hasMany(\App\Models\ProjectTSPTUpdate::class);
    }

    
    public function projectTSPTViews()
    {
        return $this->hasMany(\App\Models\ProjectTSPTView::class);
    }

    
    public function projectTSToolCreates()
    {
        return $this->hasMany(\App\Models\ProjectTSToolCreate::class);
    }

    
    public function projectTSToolDeletes()
    {
        return $this->hasMany(\App\Models\ProjectTSToolDelete::class);
    }

    
    public function projectTSToolFileCreates()
    {
        return $this->hasMany(\App\Models\ProjectTSToolFileCreate::class);
    }

    
    public function projectTSToolFileDeletes()
    {
        return $this->hasMany(\App\Models\ProjectTSToolFileDelete::class);
    }

    
    public function projectTSToolFileTodolistCreates()
    {
        return $this->hasMany(\App\Models\ProjectTSToolFileTodolistCreate::class);
    }

    
    public function projectTSToolFileTodolistDeletes()
    {
        return $this->hasMany(\App\Models\ProjectTSToolFileTodolistDelete::class);
    }

    
    public function projectTSToolFileTodolistUpdates()
    {
        return $this->hasMany(\App\Models\ProjectTSToolFileTodolistUpdate::class);
    }

    
    public function projectTSToolFileTodolistViews()
    {
        return $this->hasMany(\App\Models\ProjectTSToolFileTodolistView::class);
    }

    
    public function projectTSToolFileUpdates()
    {
        return $this->hasMany(\App\Models\ProjectTSToolFileUpdate::class);
    }

    
    public function projectTSToolFileViews()
    {
        return $this->hasMany(\App\Models\ProjectTSToolFileView::class);
    }

    
    public function projectTSToolTodolistCreates()
    {
        return $this->hasMany(\App\Models\ProjectTSToolTodolistCreate::class);
    }

    
    public function projectTSToolTodolistDeletes()
    {
        return $this->hasMany(\App\Models\ProjectTSToolTodolistDelete::class);
    }

    
    public function projectTSToolTodolistUpdates()
    {
        return $this->hasMany(\App\Models\ProjectTSToolTodolistUpdate::class);
    }

    
    public function projectTSToolTodolistViews()
    {
        return $this->hasMany(\App\Models\ProjectTSToolTodolistView::class);
    }

    
    public function projectTSToolUpdates()
    {
        return $this->hasMany(\App\Models\ProjectTSToolUpdate::class);
    }

    
    public function projectTSToolViews()
    {
        return $this->hasMany(\App\Models\ProjectTSToolView::class);
    }

    
    public function projectTodolistCreates()
    {
        return $this->hasMany(\App\Models\ProjectTodolistCreate::class);
    }

    
    public function projectTodolistDeletes()
    {
        return $this->hasMany(\App\Models\ProjectTodolistDelete::class);
    }

    
    public function projectTodolistUpdates()
    {
        return $this->hasMany(\App\Models\ProjectTodolistUpdate::class);
    }

    
    public function projectTodolistViews()
    {
        return $this->hasMany(\App\Models\ProjectTodolistView::class);
    }

    
    public function projectTopicCreates()
    {
        return $this->hasMany(\App\Models\ProjectTopicCreate::class);
    }

    
    public function projectTopicDeletes()
    {
        return $this->hasMany(\App\Models\ProjectTopicDelete::class);
    }

    
    public function projectTopicSectionCreates()
    {
        return $this->hasMany(\App\Models\ProjectTopicSectionCreate::class);
    }

    
    public function projectTopicSectionDeletes()
    {
        return $this->hasMany(\App\Models\ProjectTopicSectionDelete::class);
    }

    
    public function projectTopicSectionTodolistCreates()
    {
        return $this->hasMany(\App\Models\ProjectTopicSectionTodolistCreate::class);
    }

    
    public function projectTopicSectionTodolistDeletes()
    {
        return $this->hasMany(\App\Models\ProjectTopicSectionTodolistDelete::class);
    }

    
    public function projectTopicSectionTodolistUpdates()
    {
        return $this->hasMany(\App\Models\ProjectTopicSectionTodolistUpdate::class);
    }

    
    public function projectTopicSectionTodolistViews()
    {
        return $this->hasMany(\App\Models\ProjectTopicSectionTodolistView::class);
    }

    
    public function projectTopicSectionUpdates()
    {
        return $this->hasMany(\App\Models\ProjectTopicSectionUpdate::class);
    }

    
    public function projectTopicSectionViews()
    {
        return $this->hasMany(\App\Models\ProjectTopicSectionView::class);
    }

    
    public function projectTopicTodolistCreates()
    {
        return $this->hasMany(\App\Models\ProjectTopicTodolistCreate::class);
    }

    
    public function projectTopicTodolistDeletes()
    {
        return $this->hasMany(\App\Models\ProjectTopicTodolistDelete::class);
    }

    
    public function projectTopicTodolistUpdates()
    {
        return $this->hasMany(\App\Models\ProjectTopicTodolistUpdate::class);
    }

    
    public function projectTopicTodolistViews()
    {
        return $this->hasMany(\App\Models\ProjectTopicTodolistView::class);
    }

    
    public function projectTopicUpdates()
    {
        return $this->hasMany(\App\Models\ProjectTopicUpdate::class);
    }

    
    public function projectTopicViews()
    {
        return $this->hasMany(\App\Models\ProjectTopicView::class);
    }

    
    public function projectUpdates()
    {
        return $this->hasMany(\App\Models\ProjectUpdate::class);
    }

    
    public function projectViews()
    {
        return $this->hasMany(\App\Models\ProjectView::class);
    }

    
    public function projects()
    {
        return $this->hasMany(\App\Models\Project::class);
    }

    
    public function recentActivities()
    {
        return $this->hasMany(\App\Models\RecentActivity::class);
    }

    
    public function recentActivityCreates()
    {
        return $this->hasMany(\App\Models\RecentActivityCreate::class);
    }

    
    public function recentActivityDeletes()
    {
        return $this->hasMany(\App\Models\RecentActivityDelete::class);
    }

    
    public function recentActivityUpdates()
    {
        return $this->hasMany(\App\Models\RecentActivityUpdate::class);
    }

    
    public function recentActivityViews()
    {
        return $this->hasMany(\App\Models\RecentActivityView::class);
    }

    
    public function uCTSPAudioCreates()
    {
        return $this->hasMany(\App\Models\UCTSPAudioCreate::class);
    }

    
    public function uCTSPAudioDeletes()
    {
        return $this->hasMany(\App\Models\UCTSPAudioDelete::class);
    }

    
    public function uCTSPAudioUpdates()
    {
        return $this->hasMany(\App\Models\UCTSPAudioUpdate::class);
    }

    
    public function uCTSPlaylistCreates()
    {
        return $this->hasMany(\App\Models\UCTSPlaylistCreate::class);
    }

    
    public function uCTSPlaylistDeletes()
    {
        return $this->hasMany(\App\Models\UCTSPlaylistDelete::class);
    }

    
    public function uCTSPlaylistUpdates()
    {
        return $this->hasMany(\App\Models\UCTSPlaylistUpdate::class);
    }

    
    public function uJTSPAudioCreates()
    {
        return $this->hasMany(\App\Models\UJTSPAudioCreate::class);
    }

    
    public function uJTSPAudioDeletes()
    {
        return $this->hasMany(\App\Models\UJTSPAudioDelete::class);
    }

    
    public function uJTSPAudioUpdates()
    {
        return $this->hasMany(\App\Models\UJTSPAudioUpdate::class);
    }

    
    public function uJTSPlaylistCreates()
    {
        return $this->hasMany(\App\Models\UJTSPlaylistCreate::class);
    }

    
    public function uJTSPlaylistDeletes()
    {
        return $this->hasMany(\App\Models\UJTSPlaylistDelete::class);
    }

    
    public function uJTSPlaylistUpdates()
    {
        return $this->hasMany(\App\Models\UJTSPlaylistUpdate::class);
    }

    
    public function uPDTSPAudioCreates()
    {
        return $this->hasMany(\App\Models\UPDTSPAudioCreate::class);
    }

    
    public function uPDTSPAudioDeletes()
    {
        return $this->hasMany(\App\Models\UPDTSPAudioDelete::class);
    }

    
    public function uPDTSPAudioUpdates()
    {
        return $this->hasMany(\App\Models\UPDTSPAudioUpdate::class);
    }

    
    public function uPDTSPlaylistCreates()
    {
        return $this->hasMany(\App\Models\UPDTSPlaylistCreate::class);
    }

    
    public function uPDTSPlaylistDeletes()
    {
        return $this->hasMany(\App\Models\UPDTSPlaylistDelete::class);
    }

    
    public function uPDTSPlaylistUpdates()
    {
        return $this->hasMany(\App\Models\UPDTSPlaylistUpdate::class);
    }

    
    public function uPTSPAudioCreates()
    {
        return $this->hasMany(\App\Models\UPTSPAudioCreate::class);
    }

    
    public function uPTSPAudioDeletes()
    {
        return $this->hasMany(\App\Models\UPTSPAudioDelete::class);
    }

    
    public function uPTSPAudioUpdates()
    {
        return $this->hasMany(\App\Models\UPTSPAudioUpdate::class);
    }

    
    public function uPTSPlaylistCreates()
    {
        return $this->hasMany(\App\Models\UPTSPlaylistCreate::class);
    }

    
    public function uPTSPlaylistDeletes()
    {
        return $this->hasMany(\App\Models\UPTSPlaylistDelete::class);
    }

    
    public function uPTSPlaylistUpdates()
    {
        return $this->hasMany(\App\Models\UPTSPlaylistUpdate::class);
    }

    
    public function userCollegeCs()
    {
        return $this->hasMany(\App\Models\UserCollegeC::class);
    }

    
    public function userCollegeDs()
    {
        return $this->hasMany(\App\Models\UserCollegeD::class);
    }

    
    public function userCollegeTSFileCs()
    {
        return $this->hasMany(\App\Models\UserCollegeTSFileC::class);
    }

    
    public function userCollegeTSFileDs()
    {
        return $this->hasMany(\App\Models\UserCollegeTSFileD::class);
    }

    
    public function userCollegeTSFileUs()
    {
        return $this->hasMany(\App\Models\UserCollegeTSFileU::class);
    }

    
    public function userCollegeTSFiles()
    {
        return $this->hasMany(\App\Models\UserCollegeTSFile::class);
    }

    
    public function userCollegeTSGalerieCs()
    {
        return $this->hasMany(\App\Models\UserCollegeTSGalerieC::class);
    }

    
    public function userCollegeTSGalerieDs()
    {
        return $this->hasMany(\App\Models\UserCollegeTSGalerieD::class);
    }

    
    public function userCollegeTSGalerieUs()
    {
        return $this->hasMany(\App\Models\UserCollegeTSGalerieU::class);
    }

    
    public function userCollegeTSGaleries()
    {
        return $this->hasMany(\App\Models\UserCollegeTSGalery::class);
    }

    
    public function userCollegeTSGaleryImageCs()
    {
        return $this->hasMany(\App\Models\UserCollegeTSGaleryImageC::class);
    }

    
    public function userCollegeTSGaleryImageDs()
    {
        return $this->hasMany(\App\Models\UserCollegeTSGaleryImageD::class);
    }

    
    public function userCollegeTSGaleryImageUs()
    {
        return $this->hasMany(\App\Models\UserCollegeTSGaleryImageU::class);
    }

    
    public function userCollegeTSGaleryImages()
    {
        return $this->hasMany(\App\Models\UserCollegeTSGaleryImage::class);
    }

    
    public function userCollegeTSNoteCs()
    {
        return $this->hasMany(\App\Models\UserCollegeTSNoteC::class);
    }

    
    public function userCollegeTSNoteDs()
    {
        return $this->hasMany(\App\Models\UserCollegeTSNoteD::class);
    }

    
    public function userCollegeTSNoteUs()
    {
        return $this->hasMany(\App\Models\UserCollegeTSNoteU::class);
    }

    
    public function userCollegeTSNotes()
    {
        return $this->hasMany(\App\Models\UserCollegeTSNote::class);
    }

    
    public function userCollegeTSPAudios()
    {
        return $this->hasMany(\App\Models\UserCollegeTSPAudio::class);
    }

    
    public function userCollegeTSPlaylists()
    {
        return $this->hasMany(\App\Models\UserCollegeTSPlaylist::class);
    }

    
    public function userCollegeTSToolCs()
    {
        return $this->hasMany(\App\Models\UserCollegeTSToolC::class);
    }

    
    public function userCollegeTSToolDs()
    {
        return $this->hasMany(\App\Models\UserCollegeTSToolD::class);
    }

    
    public function userCollegeTSToolFileCs()
    {
        return $this->hasMany(\App\Models\UserCollegeTSToolFileC::class);
    }

    
    public function userCollegeTSToolFileDs()
    {
        return $this->hasMany(\App\Models\UserCollegeTSToolFileD::class);
    }

    
    public function userCollegeTSToolFileUs()
    {
        return $this->hasMany(\App\Models\UserCollegeTSToolFileU::class);
    }

    
    public function userCollegeTSToolFiles()
    {
        return $this->hasMany(\App\Models\UserCollegeTSToolFile::class);
    }

    
    public function userCollegeTSToolUs()
    {
        return $this->hasMany(\App\Models\UserCollegeTSToolU::class);
    }

    
    public function userCollegeTSTools()
    {
        return $this->hasMany(\App\Models\UserCollegeTSTool::class);
    }

    
    public function userCollegeTopicCs()
    {
        return $this->hasMany(\App\Models\UserCollegeTopicC::class);
    }

    
    public function userCollegeTopicDs()
    {
        return $this->hasMany(\App\Models\UserCollegeTopicD::class);
    }

    
    public function userCollegeTopicSectionCs()
    {
        return $this->hasMany(\App\Models\UserCollegeTopicSectionC::class);
    }

    
    public function userCollegeTopicSectionDs()
    {
        return $this->hasMany(\App\Models\UserCollegeTopicSectionD::class);
    }

    
    public function userCollegeTopicSectionUs()
    {
        return $this->hasMany(\App\Models\UserCollegeTopicSectionU::class);
    }

    
    public function userCollegeTopicSections()
    {
        return $this->hasMany(\App\Models\UserCollegeTopicSection::class);
    }

    
    public function userCollegeTopicUs()
    {
        return $this->hasMany(\App\Models\UserCollegeTopicU::class);
    }

    
    public function userCollegeTopics()
    {
        return $this->hasMany(\App\Models\UserCollegeTopic::class);
    }

    
    public function userCollegeUs()
    {
        return $this->hasMany(\App\Models\UserCollegeU::class);
    }

    
    public function userColleges()
    {
        return $this->hasMany(\App\Models\UserCollege::class);
    }

    
    public function userJobCs()
    {
        return $this->hasMany(\App\Models\UserJobC::class);
    }

    
    public function userJobDs()
    {
        return $this->hasMany(\App\Models\UserJobD::class);
    }

    
    public function userJobTSFileCs()
    {
        return $this->hasMany(\App\Models\UserJobTSFileC::class);
    }

    
    public function userJobTSFileDs()
    {
        return $this->hasMany(\App\Models\UserJobTSFileD::class);
    }

    
    public function userJobTSFileUs()
    {
        return $this->hasMany(\App\Models\UserJobTSFileU::class);
    }

    
    public function userJobTSFiles()
    {
        return $this->hasMany(\App\Models\UserJobTSFile::class);
    }

    
    public function userJobTSGalerieCs()
    {
        return $this->hasMany(\App\Models\UserJobTSGalerieC::class);
    }

    
    public function userJobTSGalerieDs()
    {
        return $this->hasMany(\App\Models\UserJobTSGalerieD::class);
    }

    
    public function userJobTSGalerieUs()
    {
        return $this->hasMany(\App\Models\UserJobTSGalerieU::class);
    }

    
    public function userJobTSGaleries()
    {
        return $this->hasMany(\App\Models\UserJobTSGalery::class);
    }

    
    public function userJobTSGaleryImageCs()
    {
        return $this->hasMany(\App\Models\UserJobTSGaleryImageC::class);
    }

    
    public function userJobTSGaleryImageDs()
    {
        return $this->hasMany(\App\Models\UserJobTSGaleryImageD::class);
    }

    
    public function userJobTSGaleryImageUs()
    {
        return $this->hasMany(\App\Models\UserJobTSGaleryImageU::class);
    }

    
    public function userJobTSGaleryImages()
    {
        return $this->hasMany(\App\Models\UserJobTSGaleryImage::class);
    }

    
    public function userJobTSNoteCs()
    {
        return $this->hasMany(\App\Models\UserJobTSNoteC::class);
    }

    
    public function userJobTSNoteDs()
    {
        return $this->hasMany(\App\Models\UserJobTSNoteD::class);
    }

    
    public function userJobTSNoteUs()
    {
        return $this->hasMany(\App\Models\UserJobTSNoteU::class);
    }

    
    public function userJobTSNotes()
    {
        return $this->hasMany(\App\Models\UserJobTSNote::class);
    }

    
    public function userJobTSPAudios()
    {
        return $this->hasMany(\App\Models\UserJobTSPAudio::class);
    }

    
    public function userJobTSPlaylists()
    {
        return $this->hasMany(\App\Models\UserJobTSPlaylist::class);
    }

    
    public function userJobTSToolCs()
    {
        return $this->hasMany(\App\Models\UserJobTSToolC::class);
    }

    
    public function userJobTSToolDs()
    {
        return $this->hasMany(\App\Models\UserJobTSToolD::class);
    }

    
    public function userJobTSToolFileCs()
    {
        return $this->hasMany(\App\Models\UserJobTSToolFileC::class);
    }

    
    public function userJobTSToolFileDs()
    {
        return $this->hasMany(\App\Models\UserJobTSToolFileD::class);
    }

    
    public function userJobTSToolFileUs()
    {
        return $this->hasMany(\App\Models\UserJobTSToolFileU::class);
    }

    
    public function userJobTSToolFiles()
    {
        return $this->hasMany(\App\Models\UserJobTSToolFile::class);
    }

    
    public function userJobTSToolUs()
    {
        return $this->hasMany(\App\Models\UserJobTSToolU::class);
    }

    
    public function userJobTSTools()
    {
        return $this->hasMany(\App\Models\UserJobTSTool::class);
    }

    
    public function userJobTopicCs()
    {
        return $this->hasMany(\App\Models\UserJobTopicC::class);
    }

    
    public function userJobTopicDs()
    {
        return $this->hasMany(\App\Models\UserJobTopicD::class);
    }

    
    public function userJobTopicSectionCs()
    {
        return $this->hasMany(\App\Models\UserJobTopicSectionC::class);
    }

    
    public function userJobTopicSectionDs()
    {
        return $this->hasMany(\App\Models\UserJobTopicSectionD::class);
    }

    
    public function userJobTopicSectionUs()
    {
        return $this->hasMany(\App\Models\UserJobTopicSectionU::class);
    }

    
    public function userJobTopicSections()
    {
        return $this->hasMany(\App\Models\UserJobTopicSection::class);
    }

    
    public function userJobTopicUs()
    {
        return $this->hasMany(\App\Models\UserJobTopicU::class);
    }

    
    public function userJobTopics()
    {
        return $this->hasMany(\App\Models\UserJobTopic::class);
    }

    
    public function userJobUs()
    {
        return $this->hasMany(\App\Models\UserJobU::class);
    }

    
    public function userJobs()
    {
        return $this->hasMany(\App\Models\UserJob::class);
    }

    
    public function userPDTSPAudios()
    {
        return $this->hasMany(\App\Models\UserPDTSPAudio::class);
    }

    
    public function userPersonalDataCs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataC::class);
    }

    
    public function userPersonalDataDs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataD::class);
    }

    
    public function userPersonalDataTSFileCs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSFileC::class);
    }

    
    public function userPersonalDataTSFileDs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSFileD::class);
    }

    
    public function userPersonalDataTSFileUs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSFileU::class);
    }

    
    public function userPersonalDataTSFiles()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSFile::class);
    }

    
    public function userPersonalDataTSGalerieCs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSGalerieC::class);
    }

    
    public function userPersonalDataTSGalerieDs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSGalerieD::class);
    }

    
    public function userPersonalDataTSGalerieUs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSGalerieU::class);
    }

    
    public function userPersonalDataTSGaleries()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSGalery::class);
    }

    
    public function userPersonalDataTSGaleryImageCs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSGaleryImageC::class);
    }

    
    public function userPersonalDataTSGaleryImageDs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSGaleryImageD::class);
    }

    
    public function userPersonalDataTSGaleryImageUs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSGaleryImageU::class);
    }

    
    public function userPersonalDataTSGaleryImages()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSGaleryImage::class);
    }

    
    public function userPersonalDataTSNoteCs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSNoteC::class);
    }

    
    public function userPersonalDataTSNoteDs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSNoteD::class);
    }

    
    public function userPersonalDataTSNoteUs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSNoteU::class);
    }

    
    public function userPersonalDataTSNotes()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSNote::class);
    }

    
    public function userPersonalDataTSPs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSP::class);
    }

    
    public function userPersonalDataTSToolCs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSToolC::class);
    }

    
    public function userPersonalDataTSToolDs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSToolD::class);
    }

    
    public function userPersonalDataTSToolFileCs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSToolFileC::class);
    }

    
    public function userPersonalDataTSToolFileDs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSToolFileD::class);
    }

    
    public function userPersonalDataTSToolFileUs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSToolFileU::class);
    }

    
    public function userPersonalDataTSToolFiles()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSToolFile::class);
    }

    
    public function userPersonalDataTSToolUs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSToolU::class);
    }

    
    public function userPersonalDataTSTools()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTSTool::class);
    }

    
    public function userPersonalDataTopicCs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTopicC::class);
    }

    
    public function userPersonalDataTopicDs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTopicD::class);
    }

    
    public function userPersonalDataTopicSectionCs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTopicSectionC::class);
    }

    
    public function userPersonalDataTopicSectionDs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTopicSectionD::class);
    }

    
    public function userPersonalDataTopicSectionUs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTopicSectionU::class);
    }

    
    public function userPersonalDataTopicSections()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTopicSection::class);
    }

    
    public function userPersonalDataTopicUs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTopicU::class);
    }

    
    public function userPersonalDataTopics()
    {
        return $this->hasMany(\App\Models\UserPersonalDataTopic::class);
    }

    
    public function userPersonalDataUs()
    {
        return $this->hasMany(\App\Models\UserPersonalDataU::class);
    }

    
    public function userPersonalDatas()
    {
        return $this->hasMany(\App\Models\UserPersonalData::class);
    }

    
    public function userProjectCs()
    {
        return $this->hasMany(\App\Models\UserProjectC::class);
    }

    
    public function userProjectDs()
    {
        return $this->hasMany(\App\Models\UserProjectD::class);
    }

    
    public function userProjectTSFileCs()
    {
        return $this->hasMany(\App\Models\UserProjectTSFileC::class);
    }

    
    public function userProjectTSFileDs()
    {
        return $this->hasMany(\App\Models\UserProjectTSFileD::class);
    }

    
    public function userProjectTSFileUs()
    {
        return $this->hasMany(\App\Models\UserProjectTSFileU::class);
    }

    
    public function userProjectTSFiles()
    {
        return $this->hasMany(\App\Models\UserProjectTSFile::class);
    }

    
    public function userProjectTSGalerieCs()
    {
        return $this->hasMany(\App\Models\UserProjectTSGalerieC::class);
    }

    
    public function userProjectTSGalerieDs()
    {
        return $this->hasMany(\App\Models\UserProjectTSGalerieD::class);
    }

    
    public function userProjectTSGalerieUs()
    {
        return $this->hasMany(\App\Models\UserProjectTSGalerieU::class);
    }

    
    public function userProjectTSGaleries()
    {
        return $this->hasMany(\App\Models\UserProjectTSGalery::class);
    }

    
    public function userProjectTSGaleryImageCs()
    {
        return $this->hasMany(\App\Models\UserProjectTSGaleryImageC::class);
    }

    
    public function userProjectTSGaleryImageDs()
    {
        return $this->hasMany(\App\Models\UserProjectTSGaleryImageD::class);
    }

    
    public function userProjectTSGaleryImageUs()
    {
        return $this->hasMany(\App\Models\UserProjectTSGaleryImageU::class);
    }

    
    public function userProjectTSGaleryImages()
    {
        return $this->hasMany(\App\Models\UserProjectTSGaleryImage::class);
    }

    
    public function userProjectTSNoteCs()
    {
        return $this->hasMany(\App\Models\UserProjectTSNoteC::class);
    }

    
    public function userProjectTSNoteDs()
    {
        return $this->hasMany(\App\Models\UserProjectTSNoteD::class);
    }

    
    public function userProjectTSNoteUs()
    {
        return $this->hasMany(\App\Models\UserProjectTSNoteU::class);
    }

    
    public function userProjectTSNotes()
    {
        return $this->hasMany(\App\Models\UserProjectTSNote::class);
    }

    
    public function userProjectTSPAudios()
    {
        return $this->hasMany(\App\Models\UserProjectTSPAudio::class);
    }

    
    public function userProjectTSPlaylists()
    {
        return $this->hasMany(\App\Models\UserProjectTSPlaylist::class);
    }

    
    public function userProjectTSToolCs()
    {
        return $this->hasMany(\App\Models\UserProjectTSToolC::class);
    }

    
    public function userProjectTSToolDs()
    {
        return $this->hasMany(\App\Models\UserProjectTSToolD::class);
    }

    
    public function userProjectTSToolFileCs()
    {
        return $this->hasMany(\App\Models\UserProjectTSToolFileC::class);
    }

    
    public function userProjectTSToolFileDs()
    {
        return $this->hasMany(\App\Models\UserProjectTSToolFileD::class);
    }

    
    public function userProjectTSToolFileUs()
    {
        return $this->hasMany(\App\Models\UserProjectTSToolFileU::class);
    }

    
    public function userProjectTSToolFiles()
    {
        return $this->hasMany(\App\Models\UserProjectTSToolFile::class);
    }

    
    public function userProjectTSToolUs()
    {
        return $this->hasMany(\App\Models\UserProjectTSToolU::class);
    }

    
    public function userProjectTSTools()
    {
        return $this->hasMany(\App\Models\UserProjectTSTool::class);
    }

    
    public function userProjectTopicCs()
    {
        return $this->hasMany(\App\Models\UserProjectTopicC::class);
    }

    
    public function userProjectTopicDs()
    {
        return $this->hasMany(\App\Models\UserProjectTopicD::class);
    }

    
    public function userProjectTopicSectionCs()
    {
        return $this->hasMany(\App\Models\UserProjectTopicSectionC::class);
    }

    
    public function userProjectTopicSectionDs()
    {
        return $this->hasMany(\App\Models\UserProjectTopicSectionD::class);
    }

    
    public function userProjectTopicSectionUs()
    {
        return $this->hasMany(\App\Models\UserProjectTopicSectionU::class);
    }

    
    public function userProjectTopicSections()
    {
        return $this->hasMany(\App\Models\UserProjectTopicSection::class);
    }

    
    public function userProjectTopicUs()
    {
        return $this->hasMany(\App\Models\UserProjectTopicU::class);
    }

    
    public function userProjectTopics()
    {
        return $this->hasMany(\App\Models\UserProjectTopic::class);
    }

    
    public function userProjectUs()
    {
        return $this->hasMany(\App\Models\UserProjectU::class);
    }

    
    public function userProjects()
    {
        return $this->hasMany(\App\Models\UserProject::class);
    }
}