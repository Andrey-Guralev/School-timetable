<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use App\Http\Requests\StoreAnnouncementsRequest;
use App\Http\Requests\UpdateAnnouncementsRequest;
use App\Models\Classes;
use App\Models\TelegramSubscribers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class AnnouncementsController extends Controller
{



    public function index()
    {
        $announcements = Announcements::select(['id', 'title', 'text', 'type', 'class_id'])->with('Classes')->get()->sortDesc();

        return view('announcements.announcementsIndex', compact('announcements'));
    }

    public function show($id)
    {
        $announcement = Announcements::find($id);

        return view('announcements.announcementsShow', compact('announcement'));
    }

    public function create()
    {
        if (\Auth::user()->type >=3)
        {
            $classes = Classes::all();
        }
        elseif(\Auth::user()->type == 2)
        {
            $classes = Classes::where('id', \Auth::user()->class_id)->get();
        }

        return view('announcements.announcementsCreate', compact('classes'));
    }

    public function store(StoreAnnouncementsRequest $request): \Illuminate\Http\RedirectResponse
    {
        $announcement = new Announcements();

        $announcement->title = $request->title;
        $announcement->text = $request->main_text;

        if ($request->type == 'school') {
            $announcement->type = '1';
        } else {
            $announcement->type = '0';
            $announcement->class_id = $request->type;
        }

        $announcement->author_id = \Auth::user()->id;

        $announcement->save();

        if ($announcement->type == 1) {
            $subs = TelegramSubscribers::all();
        } else {
            $subs = TelegramSubscribers::where('class_id', $announcement->class_id)->get();
        }

        foreach ($subs as $sub) {
            Telegram::setAsyncRequest(true)->sendMessage([
                'chat_id' => $sub->chat_id,
                'text' => 'Новое объявление!' . chr(10) . chr(10) . 'Посмотреть: ' . env('APP_URL') . '/announcements/' . $announcement->id,
            ]);
        }

        return redirect($request->prev_url);
    }

    public function edit($id)
    {
        $classes = Classes::all();

        $announcement = Announcements::find($id);

        return view('announcements.announcementsEdit', compact('classes', 'announcement'));
    }

    public function update(StoreAnnouncementsRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $announcement = Announcements::find($id);

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

        return redirect($request->prev_url);
    }


    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $an = Announcements::find($id);

        if (!$an) {
            return redirect()->route('announcementsIndex')->with('error', 'Такого обьявления не существует');
        }

        $an->delete();

        return redirect()->back();
    }
}
