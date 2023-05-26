<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function index()
    {
        if(Auth::check())
        {
            $reviews = Review::orderBy('id', 'desc')->paginate(5);
            return view('reviews.index', compact('reviews'));
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }


    public function create()
    {
        if(Auth::check())
        {
            return view('reviews.create');
        }
        return redirect("login")->withSuccess('Opps! You do not have access');

    }
    public function update(Request $request, Review $review)
    {
        $request->validate([
            'title' => 'required',
            'product_type' => 'required',
            'review' => 'required',
        ]);

        $review->fill($request->post())->save();

        return redirect()->route('reviews.index')->with('success','Review Has Been updated successfully');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'product_type' => 'required',
            'review' => 'required',
        ]);
        $request->request->add(['user_id' => Auth::user()->id]);
        Review::create($request->post());

        return redirect()->route('reviews.index')->with('success','Review has been created successfully.');
    }

    public function edit(Review $review)
    {
        if(Auth::check()) {
            $products = ['Book', 'Film', 'Game'];
            return view('reviews.edit', compact('review', 'products'));
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('reviews.index')->with('success','Review has been deleted successfully');
    }
}
