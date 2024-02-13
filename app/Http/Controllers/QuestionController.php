<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Auth\Events\Validated;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Question', ["questions" => Question::with('answer')->latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // public function store(Request $request)
    // {
    //     // Validasi data yang diterima dari request
    //     $request->validate([
    //         'question' => 'required|string',
    //         'answer.*.answer' => 'required|string',
    //         'answer.*.correct_answer' => 'required|boolean',
    //     ]);

    //     // Simpan pertanyaan baru
    //     $newQuestion = Question::create([
    //         'question' => $request->question,
    //     ]);

    //     // Simpan jawaban-jawaban baru
    //     foreach ($request->answer as $answerData) {
    //         $newQuestion->answer()->create([
    //             'answer' => $answerData['answer'],
    //             'correct_answer' => $answerData['correct_answer'],
    //         ]);
    //     }

    //     // Redirect ke halaman tertentu setelah berhasil menyimpan data
    //     return redirect('/about')->with('success', 'Question created successfully.');
    // }

    public function store(Request $request)
    {
        $requestData = $request->all();
        $question = $requestData['question'];

        $newQuestion = new Question;
        $newQuestion->question = $question;
        $newQuestion->save();

        $answers = $requestData['answer'];

        foreach ($answers as $answer) {
            $newAnswer = new Answer;
            $newAnswer->answer = $answer['answer'];
            $newAnswer->question_id = $newQuestion->id;
            $newAnswer->correct_answer = $answer['correct_answer'];
            $newAnswer->save();
        }
        // return redirect('/questions')->with('success', 'Question created successfully.');

        return Inertia::location('/questions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
