<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\QA;
use Auth;
use Session;
use \Illuminate\Http\Request;

class QAController extends Controller
{
    /**
     * Method create
     *
     * @return void
     */
    public function create()
    {
        $categories = Category::all();
        Session::put('oldUrl', back()->getTargetUrl());
        return view('createQuestion', ['categories' => $categories]);
    }
    public function update($id)
    {
        $questionUpdate = QA::find($id);
        $categories = Category::all();
        Session::put('oldUrl', back()->getTargetUrl());
        return view('updateQuestion', ['question' => $questionUpdate, 'id' => $id, 'categories' => $categories, 'categoryname' => new Category]);

    }
    /**
     * Method submitQuestion
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitQuestion(Request $request)
    {
        $request->validate([
            'question' => 'bail|required|unique:q_a_s|min:20',
            'category' => 'required',
        ]);
        $Question = new QA;
        $Question->question = $request->input('question');
        $Question->userid = Auth::id();
        $Question->category_id = $request->input('category');
        $Question->save();

        if (Session::has('oldUrl')) {
            $oldUrl = Session::get('oldUrl');
            Session::forget('oldUrl');
            return redirect()->to($oldUrl);
        } else {
            return redirect('ask-question');
        }

    }
    /**
     * Method updateQuestion
     *
     * @param Request $request [explicite description]
     * @param $id $id [explicite description]
     *
     * @return void
     */
    public function updateQuestion(Request $request, $id)
    {
        $request->validate([
            'question' => 'bail|required|unique:q_a_s|min:20',
            'category' => 'required',
        ]);
        $Question = QA::find($id);
        $Question->question = $request->input('question');
        $Question->userid = Auth::id();
        $Question->category_id = $request->input('category');
        $Question->save();
        if (Session::has('oldUrl')) {
            $oldUrl = Session::get('oldUrl');
            Session::forget('oldUrl');
            return redirect()->to($oldUrl);
        } else {
            return redirect('ask-question');
        }
    }
    /**
     * Method askQuestion
     *
     * @return void
     */
    public function askQuestion()
    {

        return view('ask-question');
    }
    /**
     * Method guest
     *
     * @return void
     */
    public function guest()
    {
        $questions = QA::all()->toArray();

        return view('/Q&A', ['questions' => $questions]);
    }
    /**
     * Method delete
     *
     * @param $id $id [explicite description]
     *
     * @return void
     */
    public function delete($id)
    {
        QA::find($id)->delete();
        return redirect()->back();
    }
}
