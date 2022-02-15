<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use App\Http\Requests\StoreAnnouncementsRequest;
use App\Http\Requests\UpdateAnnouncementsRequest;
use App\Models\Classes;

class AnnouncementsController extends Controller
{
    public function index()
    {
        $announcements = Announcements::select(['id', 'title', 'text', 'type', 'class_id'])->with('Classes')->get();

        return view('announcements.announcementsIndex', compact('announcements'));
    }

    public function show($id)
    {
        dd('show');
    }

    public function create()
    {
        $classes = Classes::all();

        return view('announcements.announcementsCreate', compact('classes'));
    }

    public function store(StoreAnnouncementsRequest $request)
    {
        $announcement = new Announcements();

        $announcement->title = $request->title;
        $announcement->text = $request->main_text;

        if ($request->type == 'school')
        {
            $announcement->type = '1';
        }
        else
        {
            $announcement->type = '0';
            $announcement->class_id = $request->type;
        }

        $announcement->author_id = \Auth::user()->id;

        $announcement->save();

        return redirect()->route('announcementsIndex');
    }

}
