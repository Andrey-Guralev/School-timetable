<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Feedback;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Providers\RouteServiceProvider;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = Feedback::with('Class')->get();

        return view('admin.feedback.feedbackIndex', compact('feedback'));
    }

    public function all()
    {
        $feedback = Feedback::with('Class')->where('status', 1)->paginate(10);

        return view('feedback.feedbackIndex', compact('feedback'));
    }


    public function store(StoreFeedbackRequest $request)
    {
        $feedback = new Feedback();

        $feedback->first_name = strip_tags($request->first_name);
        $feedback->second_name = strip_tags($request->second_name);
        $feedback->class_id = $request->class;
        $feedback->text = strip_tags($request->text);
        $feedback->status = 0;

        $feedback->save();

//        return redirect()->back()->with('success', 'Отзыв успешно добавлен!');
        return redirect(RouteServiceProvider::HOME);
    }

    public function create()
    {
        $classes = Classes::all();
        return view('feedback.feedbackCreate', compact('classes'));
    }

    public function approve($id)
    {
        $feedback = Feedback::findOrFail($id);

        $feedback->status = 1;

        $feedback->save();

        return redirect()->back();
    }

    public function show(Feedback $feedback)
    {
        //
    }

    public function destroy($id)
    {
        Feedback::find($id)->delete();

        return redirect()->back();
    }
}
