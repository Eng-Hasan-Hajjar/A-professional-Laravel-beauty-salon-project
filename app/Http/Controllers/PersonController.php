<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index()
    {
        $people = Person::all();
        return view('admin.people.index', compact('people'));
    }

    public function create()
    {
        return view('admin.people.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'national_number' => 'required|string|max:20|unique:people,national_number',
            'birth_date' => 'required|date',
            'email' => 'required|email|max:255|unique:people,email',
        ]);

        Person::create($validated);

        return redirect()->route('people.index')->with('success', 'تم إنشاء الشخص بنجاح.');
    }

    public function edit(Person $person)
    {
        return view('admin.people.edit', compact('person'));
    }

    public function update(Request $request, Person $person)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'national_number' => 'required|string|max:20|unique:people,' ,
            'birth_date' => 'required|date',
            'email' => 'required|email|max:255|unique:people,' ,
        ]);

        $person->update($validated);

        return redirect()->route('people.index')->with('success', 'تم تحديث الشخص بنجاح.');
    }

    public function destroy(Person $person)
    {
        try {
            $person->delete();
            return redirect()->route('people.index')->with('success', 'تم حذف الشخص بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('people.index')->with('error', 'لا يمكن حذف الشخص بسبب وجود بيانات مرتبطة.');
        }
    }
}