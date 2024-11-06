<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class FormController extends Controller
{
    public function showForm()
    {
        return view('form');
    }

    // Обработка отправки формы
    public function submitForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        $filename = 'data_' . Str::uuid() . '.json';
        File::put(storage_path("app/public/{$filename}"), json_encode($data, JSON_PRETTY_PRINT));

        return redirect()->back()->with('success', 'Данные успешно сохранены!');
    }

    // Отображение данных в виде таблицы
    public function showData()
    {
        $files = File::files(storage_path('app/public'));
        $dataList = [];

        foreach ($files as $file) {
            if ($file->getExtension() === 'json') {
                $dataList[] = json_decode(File::get($file), true);
            }
        }

        return view('data', compact('dataList'));
    }

}
