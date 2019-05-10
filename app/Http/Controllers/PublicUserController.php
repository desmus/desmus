<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Auth;

class PublicUserController extends Controller
{
    public function __construct()
    {
    }
    
    public function show($id, Request $request)
    {
        $now = Carbon::now();
        
        if(isset(Auth::user()->id))
        {
            $user_id = Auth::user()->id;
            $user = DB::table('users')->where('id', '=', $user_id)->get();
        
            $files = DB::table('public_file')->where('user_id', $id)->where(function ($query) {$query->where('public_file.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(50, ['*'], 'file_p');
            $notes = DB::table('public_note')->where('user_id', $id)->where(function ($query) {$query->where('public_note.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(50, ['*'], 'note_p');
            $images = DB::table('public_image')->where('user_id', $id)->where(function ($query) {$query->where('public_image.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(50, ['*'], 'image_p');
            $audios = DB::table('public_audio')->where('user_id', $id)->where(function ($query) {$query->where('public_audio.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(50, ['*'], 'audio_p');
            $videos = DB::table('public_video')->where('user_id', $id)->where(function ($query) {$query->where('public_video.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(50, ['*'], 'video_p');
            $advertisements = DB::table('public_advertisement')->where('user_id', $id)->where(function ($query) {$query->where('public_advertisement.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(50, ['*'], 'advertising_p');
        }

        $public_files = DB::table('public_file')->where(function ($query) {$query->where('public_file.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'public_file_p');
        $public_notes = DB::table('public_note')->where(function ($query) {$query->where('public_note.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'public_note_p');
        $public_images = DB::table('public_image')->where(function ($query) {$query->where('public_image.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'public_image_p');
        $public_audios = DB::table('public_audio')->where(function ($query) {$query->where('public_audio.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'public_audio_p');
        $public_videos = DB::table('public_video')->where(function ($query) {$query->where('public_video.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'public_video_p');
        $public_advertisements = DB::table('public_advertisement')->where(function ($query) {$query->where('public_advertisement.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(5, ['*'], 'public_advertising_p');

        $i = 0;
        $j = 0;

        $public_file_users = null;
        $public_file_comments = null;
        $public_file_comment_counts = null;
        $public_file_comment_users = null;
        $public_file_likes = null;

        if(isset($public_files[0]))
        {
            foreach($public_files as $public_file)
            {
                $public_file_users[$i] = DB::table('public_file')->join('users', 'public_file.user_id', '=', 'users.id')->where('public_file.id', '=', $public_file -> id)->where(function ($query) {$query->where('public_file.deleted_at', '=', null);})->orderBy('public_file.created_at', 'desc')->paginate(2, ['*'], 'file_user_p');
                $public_file_comments[$i] = DB::table('public_file_comment')->where('public_file_id', '=', $public_file -> id)->where(function ($query) {$query->where('public_file_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(2, ['*'], 'file_comment_p');
                $public_file_comment_counts[$i] = DB::table('public_file_comment')->where('public_file_id', '=', $public_file -> id)->where(function ($query) {$query->where('public_file_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                $public_file_comment_users[$i] = DB::table('public_file_comment')->join('users', 'public_file_comment.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_file_comment.user_id', 'public_file_comment.id')->where('public_file_comment.public_file_id', '=', $public_file -> id)->where(function ($query) {$query->where('public_file_comment.deleted_at', '=', null);})->orderBy('public_file_comment.created_at', 'desc')->paginate(2, ['*'], 'file_comment_user_p');
                $public_file_likes[$i] = DB::table('public_file_like')->where('public_file_id', '=', $public_file -> id)->where(function ($query) {$query->where('public_file_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                $i += 1;
            }
        }
        
        $public_file_comment_responses = null;
        $public_file_comment_response_users = null;
        
        if(isset($public_file_comments[0]))
        {
            foreach($public_file_comments as $public_file_comment_array)
            {
                foreach($public_file_comment_array as $public_file_comment)
                {
                    $public_file_comment_responses[$j] = DB::table('public_file_comment_response')->where('public_file_comment_id', '=', $public_file_comment -> id)->where(function ($query) {$query->where('public_file_comment_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(1, ['*'], 'file_comment_response_p');
                    $public_file_comment_response_users[$j] = DB::table('public_file_comment_response')->join('users', 'public_file_comment_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_file_comment_response.user_id', 'public_file_comment_response.id')->where('public_file_comment_response.public_file_comment_id', '=', $public_file_comment -> id)->where(function ($query) {$query->where('public_file_comment_response.deleted_at', '=', null);})->orderBy('public_file_comment_response.created_at', 'desc')->paginate(1, ['*'], 'file_comment_response_user_p');
                    $j += 1;
                }
            }
        }
        
        $i = 0;
        $j = 0;
        
        $public_note_users = null;
        $public_note_comments = null;
        $public_note_comment_counts = null;
        $public_note_comment_users = null;
        $public_note_likes = null;

        if(isset($public_notes[0]))
        {
            foreach($public_notes as $public_note)
            {
                $public_note_users[$i] = DB::table('public_note')->join('users', 'public_note.user_id', '=', 'users.id')->where('public_note.id', '=', $public_note -> id)->where(function ($query) {$query->where('public_note.deleted_at', '=', null);})->orderBy('public_note.created_at', 'desc')->paginate(2, ['*'], 'note_user_p');
                $public_note_comments[$i] = DB::table('public_note_comment')->where('public_note_id', '=', $public_note -> id)->where(function ($query) {$query->where('public_note_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(2, ['*'], 'note_comment_p');
                $public_note_comment_counts[$i] = DB::table('public_note_comment')->where('public_note_id', '=', $public_note -> id)->where(function ($query) {$query->where('public_note_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                $public_note_comment_users[$i] = DB::table('public_note_comment')->join('users', 'public_note_comment.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_note_comment.user_id', 'public_note_comment.id')->where('public_note_comment.public_note_id', '=', $public_note -> id)->where(function ($query) {$query->where('public_note_comment.deleted_at', '=', null);})->orderBy('public_note_comment.created_at', 'desc')->paginate(2, ['*'], 'note_comment_user_p');
                $public_note_likes[$i] = DB::table('public_note_like')->where('public_note_id', '=', $public_note -> id)->where(function ($query) {$query->where('public_note_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                $i += 1;
            }
        }
        
        $public_note_comment_responses = null;
        $public_note_comment_response_users = null;
        
        if(isset($public_note_comments[0]))
        {
            foreach($public_note_comments as $public_note_comment_array)
            {
                foreach($public_note_comment_array as $public_note_comment)
                {
                    $public_note_comment_responses[$j] = DB::table('public_note_comment_response')->where('public_note_comment_id', '=', $public_note_comment -> id)->where(function ($query) {$query->where('public_note_comment_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(1, ['*'], 'note_comment_response_p');
                    $public_note_comment_response_users[$j] = DB::table('public_note_comment_response')->join('users', 'public_note_comment_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_note_comment_response.user_id', 'public_note_comment_response.id')->where('public_note_comment_response.public_note_comment_id', '=', $public_note_comment -> id)->where(function ($query) {$query->where('public_note_comment_response.deleted_at', '=', null);})->orderBy('public_note_comment_response.created_at', 'desc')->paginate(1, ['*'], 'note_comment_response_user_p');
                    $j += 1;
                }
            }
        }
        
        $i = 0;
        $j = 0;
        
        $public_image_users = null;
        $public_image_comments = null;
        $public_image_comment_counts = null;
        $public_image_comment_users = null;
        $public_image_likes = null;
        
        if(isset($public_images[0]))
        {
            foreach($public_images as $public_image)
            {
                $public_image_users[$i] = DB::table('public_image')->join('users', 'public_image.user_id', '=', 'users.id')->where('public_image.id', '=', $public_image -> id)->where(function ($query) {$query->where('public_image.deleted_at', '=', null);})->orderBy('public_image.created_at', 'desc')->paginate(2, ['*'], 'image_user_p');
                $public_image_comments[$i] = DB::table('public_image_comment')->where('public_image_id', '=', $public_image -> id)->where(function ($query) {$query->where('public_image_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(2, ['*'], 'image_comment_p');
                $public_image_comment_counts[$i] = DB::table('public_image_comment')->where('public_image_id', '=', $public_image -> id)->where(function ($query) {$query->where('public_image_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                $public_image_comment_users[$i] = DB::table('public_image_comment')->join('users', 'public_image_comment.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_image_comment.user_id', 'public_image_comment.id')->where('public_image_comment.public_image_id', '=', $public_image -> id)->where(function ($query) {$query->where('public_image_comment.deleted_at', '=', null);})->orderBy('public_image_comment.created_at', 'desc')->paginate(2, ['*'], 'image_comment_user_p');
                $public_image_likes[$i] = DB::table('public_image_like')->where('public_image_id', '=', $public_image -> id)->where(function ($query) {$query->where('public_image_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                $i += 1;
            }
        }
        
        $public_image_comment_responses = null;
        $public_image_comment_response_users = null;
        
        if(isset($public_image_comments[0]))
        {
            foreach($public_image_comments as $public_image_comment_array)
            {
                foreach($public_image_comment_array as $public_image_comment)
                {
                    $public_image_comment_responses[$j] = DB::table('public_image_comment_response')->where('public_image_comment_id', '=', $public_image_comment -> id)->where(function ($query) {$query->where('public_image_comment_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(1, ['*'], 'image_comment_response_p');
                    $public_image_comment_response_users[$j] = DB::table('public_image_comment_response')->join('users', 'public_image_comment_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_image_comment_response.user_id', 'public_image_comment_response.id')->where('public_image_comment_response.public_image_comment_id', '=', $public_image_comment -> id)->where(function ($query) {$query->where('public_image_comment_response.deleted_at', '=', null);})->orderBy('public_image_comment_response.created_at', 'desc')->paginate(1, ['*'], 'image_comment_response_user_p');
                    $j += 1;
                }
            }
        }
        
        $i = 0;
        $j = 0;
        
        $public_audio_users = null;
        $public_audio_comments = null;
        $public_audio_comment_counts = null;
        $public_audio_comment_users = null;
        $public_audio_likes = null;
        
        if(isset($public_audios[0]))
        {
            foreach($public_audios as $public_audio)
            {
                $public_audio_users[$i] = DB::table('public_audio')->join('users', 'public_audio.user_id', '=', 'users.id')->where('public_audio.id', '=', $public_audio -> id)->where(function ($query) {$query->where('public_audio.deleted_at', '=', null);})->orderBy('public_audio.created_at', 'desc')->paginate(2, ['*'], 'audio_user_p');
                $public_audio_comments[$i] = DB::table('public_audio_comment')->where('public_audio_id', '=', $public_audio -> id)->where(function ($query) {$query->where('public_audio_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(2, ['*'], 'audio_comment_p');
                $public_audio_comment_counts[$i] = DB::table('public_audio_comment')->where('public_audio_id', '=', $public_audio -> id)->where(function ($query) {$query->where('public_audio_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                $public_audio_comment_users[$i] = DB::table('public_audio_comment')->join('users', 'public_audio_comment.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_audio_comment.user_id', 'public_audio_comment.id')->where('public_audio_comment.public_audio_id', '=', $public_audio -> id)->where(function ($query) {$query->where('public_audio_comment.deleted_at', '=', null);})->orderBy('public_audio_comment.created_at', 'desc')->paginate(2, ['*'], 'audio_comment_user_p');
                $public_audio_likes[$i] = DB::table('public_audio_like')->where('public_audio_id', '=', $public_audio -> id)->where(function ($query) {$query->where('public_audio_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                $i += 1;
            }
        }
        
        $public_audio_comment_responses = null;
        $public_audio_comment_response_users = null;
        
        if(isset($public_audio_comments[0]))
        {
            foreach($public_audio_comments as $public_audio_comment_array)
            {
                foreach($public_audio_comment_array as $public_audio_comment)
                {
                    $public_audio_comment_responses[$j] = DB::table('public_audio_comment_response')->where('public_audio_comment_id', '=', $public_audio_comment -> id)->where(function ($query) {$query->where('public_audio_comment_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(1, ['*'], 'audio_comment_response_p');
                    $public_audio_comment_response_users[$j] = DB::table('public_audio_comment_response')->join('users', 'public_audio_comment_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_audio_comment_response.user_id', 'public_audio_comment_response.id')->where('public_audio_comment_response.public_audio_comment_id', '=', $public_audio_comment -> id)->where(function ($query) {$query->where('public_audio_comment_response.deleted_at', '=', null);})->orderBy('public_audio_comment_response.created_at', 'desc')->paginate(1, ['*'], 'audio_comment_response_user_p');
                    $j += 1;
                }
            }
        }
        
        $i = 0;
        $j = 0;
        
        $public_video_users = null;
        $public_video_comments = null;
        $public_video_comment_counts = null;
        $public_video_comment_users = null;
        $public_video_likes = null;
        
        if(isset($public_videos[0]))
        {
            foreach($public_videos as $public_video)
            {
                $public_video_users[$i] = DB::table('public_video')->join('users', 'public_video.user_id', '=', 'users.id')->where('public_video.id', '=', $public_video -> id)->where(function ($query) {$query->where('public_video.deleted_at', '=', null);})->orderBy('public_video.created_at', 'desc')->paginate(2, ['*'], 'video_user_p');
                $public_video_comments[$i] = DB::table('public_video_comment')->where('public_video_id', '=', $public_video -> id)->where(function ($query) {$query->where('public_video_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(2, ['*'], 'video_comment_p');
                $public_video_comment_counts[$i] = DB::table('public_video_comment')->where('public_video_id', '=', $public_video -> id)->where(function ($query) {$query->where('public_video_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                $public_video_comment_users[$i] = DB::table('public_video_comment')->join('users', 'public_video_comment.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_video_comment.user_id', 'public_video_comment.id')->where('public_video_comment.public_video_id', '=', $public_video -> id)->where(function ($query) {$query->where('public_video_comment.deleted_at', '=', null);})->orderBy('public_video_comment.created_at', 'desc')->paginate(2, ['*'], 'video_comment_user_p');
                $public_video_likes[$i] = DB::table('public_video_like')->where('public_video_id', '=', $public_video -> id)->where(function ($query) {$query->where('public_video_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                $i += 1;
            }
        }
        
        $public_video_comment_responses = null;
        $public_video_comment_response_users = null;
        
        if(isset($public_video_comments[0]))
        {
            foreach($public_video_comments as $public_video_comment_array)
            {
                foreach($public_video_comment_array as $public_video_comment)
                {
                    $public_video_comment_responses[$j] = DB::table('public_video_comment_response')->where('public_video_comment_id', '=', $public_video_comment -> id)->where(function ($query) {$query->where('public_video_comment_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(1, ['*'], 'video_comment_response_p');
                    $public_video_comment_response_users[$j] = DB::table('public_video_comment_response')->join('users', 'public_video_comment_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_video_comment_response.user_id', 'public_video_comment_response.id')->where('public_video_comment_response.public_video_comment_id', '=', $public_video_comment -> id)->where(function ($query) {$query->where('public_video_comment_response.deleted_at', '=', null);})->orderBy('public_video_comment_response.created_at', 'desc')->paginate(1, ['*'], 'video_comment_response_user_p');
                    $j += 1;
                }
            }
        }
        
        $i = 0;
        $j = 0;
        
        $public_advertisement_users = null;
        $public_advertisement_comments = null;
        $public_advertisement_comment_counts = null;
        $public_advertisement_comment_users = null;
        $public_advertisement_likes = null;
        
        if(isset($public_advertisements[0]))
        {
            foreach($public_advertisements as $public_advertisement)
            {
                $public_advertisement_users[$i] = DB::table('public_advertisement')->join('users', 'public_advertisement.user_id', '=', 'users.id')->where('public_advertisement.id', '=', $public_advertisement -> id)->where(function ($query) {$query->where('public_advertisement.deleted_at', '=', null);})->orderBy('public_advertisement.created_at', 'desc')->paginate(2, ['*'], 'advertisement_user_p');
                $public_advertisement_comments[$i] = DB::table('public_advertisement_comment')->where('public_advertisement_id', '=', $public_advertisement -> id)->where(function ($query) {$query->where('public_advertisement_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(2, ['*'], 'advertising_comment_p');
                $public_advertisement_comment_counts[$i] = DB::table('public_advertisement_comment')->where('public_advertisement_id', '=', $public_advertisement -> id)->where(function ($query) {$query->where('public_advertisement_comment.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                $public_advertisement_comment_users[$i] = DB::table('public_advertisement_comment')->join('users', 'public_advertisement_comment.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_advertisement_comment.user_id', 'public_advertisement_comment.id')->where('public_advertisement_comment.public_advertisement_id', '=', $public_advertisement -> id)->where(function ($query) {$query->where('public_advertisement_comment.deleted_at', '=', null);})->orderBy('public_advertisement_comment.created_at', 'desc')->paginate(2, ['*'], 'advertisement_comment_user_p');
                $public_advertisement_likes[$i] = DB::table('public_advertisement_like')->where('public_advertisement_id', '=', $public_advertisement -> id)->where(function ($query) {$query->where('public_advertisement_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                $i += 1;
            }
        }
        
        $public_advertisement_comment_responses = null;
        $public_advertisement_comment_response_users = null;
        
        if(isset($public_advertisement_comments[0]))
        {
            foreach($public_advertisement_comments as $public_advertisement_comment_array)
            {
                foreach($public_advertisement_comment_array as $public_advertisement_comment)
                {
                    $public_advertisement_comment_responses[$j] = DB::table('public_advertisement_c_response')->where('public_a_c_id', '=', $public_advertisement_comment -> id)->where(function ($query) {$query->where('public_advertisement_c_response.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(1, ['*'], 'advertisement_comment_response_p');
                    $public_advertisement_comment_response_users[$j] = DB::table('public_advertisement_c_response')->join('users', 'public_advertisement_c_response.user_id', '=', 'users.id')->select('users.name', 'users.image_type', 'public_advertisement_c_response.user_id', 'public_advertisement_c_response.id')->where('public_advertisement_c_response.public_a_c_id', '=', $public_advertisement_comment -> id)->where(function ($query) {$query->where('public_advertisement_c_response.deleted_at', '=', null);})->orderBy('public_advertisement_c_response.created_at', 'desc')->paginate(1, ['*'], 'advertisement_comment_response_user_p');
                    $j += 1;
                }
            }
        }
        
        $public_files_list = DB::table('public_file')->where('user_id', $id)->where(function ($query) {$query->where('public_file.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(30, ['*'], 'public_file_list_p');
        $public_notes_list = DB::table('public_note')->where('user_id', $id)->where(function ($query) {$query->where('public_note.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(30, ['*'], 'public_note_list_p');
        $public_images_list = DB::table('public_image')->where('user_id', $id)->where(function ($query) {$query->where('public_image.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(30, ['*'], 'public_image_list_p');
        $public_audios_list = DB::table('public_audio')->where('user_id', $id)->where(function ($query) {$query->where('public_audio.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(30, ['*'], 'public_audio_list_p');
        $public_videos_list = DB::table('public_video')->where('user_id', $id)->where(function ($query) {$query->where('public_video.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(30, ['*'], 'public_video_list_p');
        $public_advertisements_list = DB::table('public_advertisement')->where('user_id', $id)->where(function ($query) {$query->where('public_advertisement.deleted_at', '=', null);})->orderBy('created_at', 'desc')->paginate(30, ['*'], 'public_advertising_list_p');

        $i = 0;
        $j = 0;

        $public_file_users_list = null;
        $public_file_likes_list = null;

        if(isset($public_files_list[0]))
        {
            foreach($public_files_list as $public_file_list)
            {
                $public_file_users_list[$i] = DB::table('public_file')->join('users', 'public_file.user_id', '=', 'users.id')->where('public_file.id', '=', $public_file_list -> id)->where(function ($query) {$query->where('public_file.deleted_at', '=', null);})->orderBy('public_file.created_at', 'desc')->paginate(30, ['*'], 'file_user_list_p');
                $public_file_likes_list[$i] = DB::table('public_file_like')->where('public_file_id', '=', $public_file_list -> id)->where(function ($query) {$query->where('public_file_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                $i += 1;
            }
        }
        
        $i = 0;
        $j = 0;
        
        $public_note_users_list = null;
        $public_note_likes_list = null;

        if(isset($public_notes_list[0]))
        {
            foreach($public_notes_list as $public_note_list)
            {
                $public_note_users_list[$i] = DB::table('public_note')->join('users', 'public_note.user_id', '=', 'users.id')->where('public_note.id', '=', $public_note_list -> id)->where(function ($query) {$query->where('public_note.deleted_at', '=', null);})->orderBy('public_note.created_at', 'desc')->paginate(30, ['*'], 'note_user_list_p');
                $public_note_likes_list[$i] = DB::table('public_note_like')->where('public_note_id', '=', $public_note_list -> id)->where(function ($query) {$query->where('public_note_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                $i += 1;
            }
        }
        
        $i = 0;
        $j = 0;
        
        $public_image_users_list = null;
        $public_image_likes_list = null;
        
        if(isset($public_images_list[0]))
        {
            foreach($public_images_list as $public_image_list)
            {
                $public_image_users_list[$i] = DB::table('public_image')->join('users', 'public_image.user_id', '=', 'users.id')->where('public_image.id', '=', $public_image_list -> id)->where(function ($query) {$query->where('public_image.deleted_at', '=', null);})->orderBy('public_image.created_at', 'desc')->paginate(30, ['*'], 'image_user_list_p');
                $public_image_likes_list[$i] = DB::table('public_image_like')->where('public_image_id', '=', $public_image_list -> id)->where(function ($query) {$query->where('public_image_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                $i += 1;
            }
        }
        
        $i = 0;
        $j = 0;
        
        $public_audio_users_list = null;
        $public_audio_likes_list = null;
        
        if(isset($public_audios_list[0]))
        {
            foreach($public_audios_list as $public_audio_list)
            {
                $public_audio_users_list[$i] = DB::table('public_audio')->join('users', 'public_audio.user_id', '=', 'users.id')->where('public_audio.id', '=', $public_audio_list -> id)->where(function ($query) {$query->where('public_audio.deleted_at', '=', null);})->orderBy('public_audio.created_at', 'desc')->paginate(30, ['*'], 'audio_user_list_p');
                $public_audio_likes_list[$i] = DB::table('public_audio_like')->where('public_audio_id', '=', $public_audio_list -> id)->where(function ($query) {$query->where('public_audio_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                $i += 1;
            }
        }
        
        $i = 0;
        $j = 0;
        
        $public_video_users_list = null;
        $public_video_likes_list = null;
        
        if(isset($public_videos_list[0]))
        {
            foreach($public_videos_list as $public_video_list)
            {
                $public_video_users_list[$i] = DB::table('public_video')->join('users', 'public_video.user_id', '=', 'users.id')->where('public_video.id', '=', $public_video_list -> id)->where(function ($query) {$query->where('public_video.deleted_at', '=', null);})->orderBy('public_video.created_at', 'desc')->paginate(30, ['*'], 'video_user_p');
                $public_video_likes_list[$i] = DB::table('public_video_like')->where('public_video_id', '=', $public_video_list -> id)->where(function ($query) {$query->where('public_video_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                $i += 1;
            }
        }
        
        $i = 0;
        $j = 0;
        
        $public_advertisement_users_list = null;
        $public_advertisement_likes_list = null;
        
        if(isset($public_advertisements_list[0]))
        {
            foreach($public_advertisements_list as $public_advertisement_list)
            {
                $public_advertisement_users_list[$i] = DB::table('public_advertisement')->join('users', 'public_advertisement.user_id', '=', 'users.id')->where('public_advertisement.id', '=', $public_advertisement_list -> id)->where(function ($query) {$query->where('public_advertisement.deleted_at', '=', null);})->orderBy('public_advertisement.created_at', 'desc')->paginate(30, ['*'], 'advertisement_user_p');
                $public_advertisement_likes_list[$i] = DB::table('public_advertisement_like')->where('public_advertisement_id', '=', $public_advertisement_list -> id)->where(function ($query) {$query->where('public_advertisement_like.deleted_at', '=', null);})->orderBy('created_at', 'desc')->get();
                $i += 1;
            }
        }
        
        $files_list = DB::table('public_file')->where('user_id', $id)->where(function ($query) {$query->where('public_file.deleted_at', '=', null);})->orderBy('created_at', 'desc')->limit(10)->get();
        $notes_list = DB::table('public_note')->where('user_id', $id)->where(function ($query) {$query->where('public_note.deleted_at', '=', null);})->orderBy('created_at', 'desc')->limit(10)->get();
        $images_list = DB::table('public_image')->where('user_id', $id)->where(function ($query) {$query->where('public_image.deleted_at', '=', null);})->orderBy('created_at', 'desc')->limit(10)->get();
        $audios_list = DB::table('public_audio')->where('user_id', $id)->where(function ($query) {$query->where('public_audio.deleted_at', '=', null);})->orderBy('created_at', 'desc')->limit(10)->get();
        $videos_list = DB::table('public_video')->where('user_id', $id)->where(function ($query) {$query->where('public_video.deleted_at', '=', null);})->orderBy('created_at', 'desc')->limit(10)->get();
        $advertisements_list = DB::table('public_advertisement')->where('user_id', $id)->where(function ($query) {$query->where('public_advertisement.deleted_at', '=', null);})->orderBy('created_at', 'desc')->limit(10)->get();

        if(isset(Auth::user()->id))
        {
            return view('publicUser')
                ->with('user', $user)
                ->with('files', $files)
                ->with('notes', $notes)
                ->with('images', $images)
                ->with('audios', $audios)
                ->with('videos', $videos)
                ->with('advertisements', $advertisements)
                ->with('publicFiles', $public_files)
                ->with('publicNotes', $public_notes)
                ->with('publicImages', $public_images)
                ->with('publicAudios', $public_audios)
                ->with('publicVideos', $public_videos)
                ->with('publicAdvertisements', $public_advertisements)
                ->with('publicFileUsers', $public_file_users)
                ->with('publicNoteUsers', $public_note_users)
                ->with('publicImageUsers', $public_image_users)
                ->with('publicAudioUsers', $public_audio_users)
                ->with('publicVideoUsers', $public_video_users)
                ->with('publicAdvertisementUsers', $public_advertisement_users)
                ->with('publicFileComments', $public_file_comments)
                ->with('publicNoteComments', $public_note_comments)
                ->with('publicImageComments', $public_image_comments)
                ->with('publicAudioComments', $public_audio_comments)
                ->with('publicVideoComments', $public_video_comments)
                ->with('publicAdvertisementComments', $public_advertisement_comments)
                ->with('publicFileCommentUsers', $public_file_comment_users)
                ->with('publicNoteCommentUsers', $public_note_comment_users)
                ->with('publicImageCommentUsers', $public_image_comment_users)
                ->with('publicAudioCommentUsers', $public_audio_comment_users)
                ->with('publicVideoCommentUsers', $public_video_comment_users)
                ->with('publicAdvertisementCommentUsers', $public_advertisement_comment_users)
                ->with('publicFileCommentCounts', $public_file_comment_counts)
                ->with('publicNoteCommentCounts', $public_note_comment_counts)
                ->with('publicImageCommentCounts', $public_image_comment_counts)
                ->with('publicAudioCommentCounts', $public_audio_comment_counts)
                ->with('publicVideoCommentCounts', $public_video_comment_counts)
                ->with('publicAdvertisementCommentCounts', $public_advertisement_comment_counts)
                ->with('publicFileLikes', $public_file_likes)
                ->with('publicNoteLikes', $public_note_likes)
                ->with('publicImageLikes', $public_image_likes)
                ->with('publicAudioLikes', $public_audio_likes)
                ->with('publicVideoLikes', $public_video_likes)
                ->with('publicAdvertisementLikes', $public_advertisement_likes)
                ->with('publicFileCommentResponses', $public_file_comment_responses)
                ->with('publicNoteCommentResponses', $public_note_comment_responses)
                ->with('publicImageCommentResponses', $public_image_comment_responses)
                ->with('publicAudioCommentResponses', $public_audio_comment_responses)
                ->with('publicVideoCommentResponses', $public_video_comment_responses)
                ->with('publicAdvertisementCResponses', $public_advertisement_comment_responses)
                ->with('publicFileCommentResponseUsers', $public_file_comment_response_users)
                ->with('publicNoteCommentResponseUsers', $public_note_comment_response_users)
                ->with('publicImageCommentResponseUsers', $public_image_comment_response_users)
                ->with('publicAudioCommentResponseUsers', $public_audio_comment_response_users)
                ->with('publicVideoCommentResponseUsers', $public_video_comment_response_users)
                ->with('publicAdvertisementCResponseUsers', $public_advertisement_comment_response_users)
                ->with('now', $now)
                ->with('user_id', $user_id)
                ->with('files_list', $files_list)
                ->with('notes_list', $notes_list)
                ->with('images_list', $images_list)
                ->with('audios_list', $audios_list)
                ->with('videos_list', $videos_list)
                ->with('advertisements_list', $advertisements_list)
                ->with('publicFilesList', $public_files_list)
                ->with('publicNotesList', $public_notes_list)
                ->with('publicImagesList', $public_images_list)
                ->with('publicAudiosList', $public_audios_list)
                ->with('publicVideosList', $public_videos_list)
                ->with('publicAdvertisementsList', $public_advertisements_list)
                ->with('publicFileUsersList', $public_file_users_list)
                ->with('publicNoteUsersList', $public_note_users_list)
                ->with('publicImageUsersList', $public_image_users_list)
                ->with('publicAudioUsersList', $public_audio_users_list)
                ->with('publicVideoUsersList', $public_video_users_list)
                ->with('publicAdvertisementUsersList', $public_advertisement_users_list)
                ->with('publicFileLikesList', $public_file_likes_list)
                ->with('publicNoteLikesList', $public_note_likes_list)
                ->with('publicImageLikesList', $public_image_likes_list)
                ->with('publicAudioLikesList', $public_audio_likes_list)
                ->with('publicVideoLikesList', $public_video_likes_list)
                ->with('publicAdvertisementLikesList', $public_advertisement_likes_list);
        }
        
        else
        {
            return view('publicUser')
                ->with('publicFiles', $public_files)
                ->with('publicNotes', $public_notes)
                ->with('publicImages', $public_images)
                ->with('publicAudios', $public_audios)
                ->with('publicVideos', $public_videos)
                ->with('publicAdvertisements', $public_advertisements)
                ->with('publicFileUsers', $public_file_users)
                ->with('publicNoteUsers', $public_note_users)
                ->with('publicImageUsers', $public_image_users)
                ->with('publicAudioUsers', $public_audio_users)
                ->with('publicVideoUsers', $public_video_users)
                ->with('publicAdvertisementUsers', $public_advertisement_users)
                ->with('publicFileComments', $public_file_comments)
                ->with('publicNoteComments', $public_note_comments)
                ->with('publicImageComments', $public_image_comments)
                ->with('publicAudioComments', $public_audio_comments)
                ->with('publicVideoComments', $public_video_comments)
                ->with('publicAdvertisementComments', $public_advertisement_comments)
                ->with('publicFileCommentUsers', $public_file_comment_users)
                ->with('publicNoteCommentUsers', $public_note_comment_users)
                ->with('publicImageCommentUsers', $public_image_comment_users)
                ->with('publicAudioCommentUsers', $public_audio_comment_users)
                ->with('publicVideoCommentUsers', $public_video_comment_users)
                ->with('publicAdvertisementCommentUsers', $public_advertisement_comment_users)
                ->with('publicFileCommentCounts', $public_file_comment_counts)
                ->with('publicNoteCommentCounts', $public_note_comment_counts)
                ->with('publicImageCommentCounts', $public_image_comment_counts)
                ->with('publicAudioCommentCounts', $public_audio_comment_counts)
                ->with('publicVideoCommentCounts', $public_video_comment_counts)
                ->with('publicAdvertisementCommentCounts', $public_advertisement_comment_counts)
                ->with('publicFileLikes', $public_file_likes)
                ->with('publicNoteLikes', $public_note_likes)
                ->with('publicImageLikes', $public_image_likes)
                ->with('publicAudioLikes', $public_audio_likes)
                ->with('publicVideoLikes', $public_video_likes)
                ->with('publicAdvertisementLikes', $public_advertisement_likes)
                ->with('publicFileCommentResponses', $public_file_comment_responses)
                ->with('publicNoteCommentResponses', $public_note_comment_responses)
                ->with('publicImageCommentResponses', $public_image_comment_responses)
                ->with('publicAudioCommentResponses', $public_audio_comment_responses)
                ->with('publicVideoCommentResponses', $public_video_comment_responses)
                ->with('publicAdvertisementCResponses', $public_advertisement_comment_responses)
                ->with('publicFileCommentResponseUsers', $public_file_comment_response_users)
                ->with('publicNoteCommentResponseUsers', $public_note_comment_response_users)
                ->with('publicImageCommentResponseUsers', $public_image_comment_response_users)
                ->with('publicAudioCommentResponseUsers', $public_audio_comment_response_users)
                ->with('publicVideoCommentResponseUsers', $public_video_comment_response_users)
                ->with('publicAdvertisementCResponseUsers', $public_advertisement_comment_response_users)
                ->with('now', $now)
                ->with('files_list', $files_list)
                ->with('notes_list', $notes_list)
                ->with('images_list', $images_list)
                ->with('audios_list', $audios_list)
                ->with('videos_list', $videos_list)
                ->with('advertisements_list', $advertisements_list)
                ->with('publicFilesList', $public_files_list)
                ->with('publicNotesList', $public_notes_list)
                ->with('publicImagesList', $public_images_list)
                ->with('publicAudiosList', $public_audios_list)
                ->with('publicVideosList', $public_videos_list)
                ->with('publicAdvertisementsList', $public_advertisements_list)
                ->with('publicFileUsersList', $public_file_users_list)
                ->with('publicNoteUsersList', $public_note_users_list)
                ->with('publicImageUsersList', $public_image_users_list)
                ->with('publicAudioUsersList', $public_audio_users_list)
                ->with('publicVideoUsersList', $public_video_users_list)
                ->with('publicFileLikesList', $public_file_likes_list)
                ->with('publicNoteLikesList', $public_note_likes_list)
                ->with('publicImageLikesList', $public_image_likes_list)
                ->with('publicAudioLikesList', $public_audio_likes_list)
                ->with('publicVideoLikesList', $public_video_likes_list)
                ->with('publicAdvertisementLikesList', $public_advertisement_likes_list);
        }
    }
}