<?php

namespace App\Http\Controllers;

use RRule\RRule;
use App\Models\Classes;
use Illuminate\Http\Request;
use App\Services\ClassesService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ClassesController extends Controller
{

    public function index()
    {
        $classes = [];
        foreach (Classes::all() as $class) {
            $classes[] = $class;
        }

        return view('classes.index', ['classes' => $classes]);
    }


    public function show(Classes $class)
    {

        if ($class) {
            // Assuming you have a 'show.blade.php' view for displaying class details
            return view('classes.show', ['class' => $class]);
        } else {
            // Handle the case where the class with the given ID was not found
            return abort(404);
        }
    }

    public function store(Request $request)
    {
        $class = app(ClassesService::class);
        $class->store($request);
        return redirect()->route('dashboard')->with('message', 'Class created successfully')->with('status', 200);
    }
}
