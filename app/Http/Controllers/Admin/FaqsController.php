<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Exception;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    function all(){
        return $this->view('admin.faqs.all', [
            'faqs' => Faq::latest()->paginate(10)
        ]);
    }

    function add(Request $request){
        if($request->isMethod('GET')){
            return $this->view('admin.faqs.add');
        }

        try{
            $validator = validator($request->post(), [
                'question' => 'required',
                'answer' => 'required'
            ]);

            if($validator->fails()){
                return back()->withInput()->withErrors($validator->errors());
            }

            $faq = Faq::create([
                'question' => $request->post('question'),
                'answer' => $request->post('answer'),
            ]);

            $faq->save();

            return back()->with([
                'status' => 'FAQ added successfully'
            ]);

        }catch(Exception $e){
            return back()->withInput()->withErrors([
                'status' => 'Something went wrong. Please try again'
            ]);
        }

    }

    function update(Request $request, $faq){
        if($request->isMethod('GET')){
            return $this->view('admin.faqs.update', [
                'faq' => $faq
            ]);
        }

        try{
            $validator = validator($request->post(), [
                'question' => 'required',
                'answer' => 'required'
            ]);

            if($validator->fails()){
                return back()->withInput()->withErrors($validator->errors());
            }

            $faq->update([
                'question' => $request->post('question'),
                'answer' => $request->post('answer'),
            ]);

            $faq->save();

            return back()->with([
                'status' => 'FAQ updated successfully'
            ]);

        }catch(Exception $e){
            return back()->withInput()->withErrors([
                'status' => 'Something went wrong. Please try again'
            ]);
        }

    }

    function delete($faq){
        try{
            $faq->delete();

            return redirect()->route('admin.faqs.all')->with([
                'status' => 'FAQ deleted successfully'
            ]);

        }catch(Exception $e){
            return back()->withInput()->withErrors([
                'status' => 'Something went wrong. Please try again'
            ]);
        }
    }
}
