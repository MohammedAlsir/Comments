<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Background;
use Illuminate\Support\Facades\Storage;

class BackgroundController extends Controller
{
    // عرض صفحة إضافة الصور مع عرض جميع الصور الموجودة
    public function index()
    {
        $backgrounds = Background::latest()->get();
        return view('backgrounds_manage', compact('backgrounds'));
    }

    // حفظ الصورة الجديدة
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('backgrounds', 'public');

        Background::create([
            'image_url' => 'storage/' . $path
        ]);

        return redirect()->route('backgrounds.index')->with('success', 'تم إضافة الخلفية بنجاح!');
    }

    // حذف صورة
    public function destroy($id)
    {
        $background = Background::findOrFail($id);

        // حذف الملف من التخزين
        // حذف 'storage/' من بداية المسار قبل استخدام Storage::delete
        $filePath = str_replace('storage/', '', $background->image_url);
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        // حذف السجل من قاعدة البيانات
        $background->delete();

        return redirect()->route('backgrounds.index')->with('success', 'تم حذف الخلفية بنجاح!');
    }
}
