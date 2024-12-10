<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::latest()->get();
        return view('comments', compact('comments'));
    }

    // عرض صفحة التعليقات
    public function create()
    {
        // $comments = Comment::latest()->get();
        return view('form');
    }

    // تخزين التعليق الجديد
    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $validatedData = $request->validate([
            'user_name' => 'nullable|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // حفظ التعليق في قاعدة البيانات
        Comment::create([
            'user_name' => $validatedData['user_name'],
            'comment' => $validatedData['comment'],
            'rating' => $validatedData['rating'],
        ]);

        // إعادة التوجيه مع رسالة شكر
        return redirect()->route('comments.create')->with('success', 'شكرًا لك! لقد تم استلام تعليقك بنجاح.');
    }
}
