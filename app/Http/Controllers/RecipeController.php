<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RecipeController extends Controller
{
    public function index()//Attēlo receptes sarakstu
    {
        $recipes = Recipe::get();
        return view('recipe.index', compact('recipes'));
    }

    public function create()//Parāda lapu, jaunas receptes izveidei.
    {
        $categories = Category::all();
        return view('recipe.create', compact('categories'));
    }

    public function store(Request $request)//saglabā receptes datus datubāzē.
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'description' => 'required|max:255|string',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp',
            'ingredients' => 'nullable|string',
            'link' => 'nullable|string',
            'categories' => 'nullable|array',
        ]);

        $path = '';// Inicializē tukšu ceļu
        if ($request->hasFile('image')) {//pārbauda vai ir fails ar nosaukumu 'image'.
            $path = $request->file('image')->store('uploads/recipe', 'public');//saglabā 'image' failu.
        }

        $recipe = Recipe::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path,
            'ingredients' => $request->ingredients,
            'link' => $request->link,
        ]);

        $recipe->categories()->sync($request->categories);

        return redirect()->route('home')->with('status', 'Recipe Created');
    }

    public function edit($id)//rediģē recepti
    {
        $recipe = Recipe::findOrFail($id);
        $categories = Category::all();
        return view('recipe.edit', compact('recipe', 'categories'));
    }

    public function update(Request $request, $id)//atjaunina recepti
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'description' => 'required|max:255|string',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp',
            'ingredients' => 'nullable|string',
            'link' => 'nullable|string',
            'categories' => 'nullable|array',
        ]);

        $recipe = Recipe::findOrFail($id);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/recipe', 'public');
            File::delete(storage_path('app/public/' . $recipe->image));
            $recipe->image = $path;
        }

        $recipe->name = $request->name;
        $recipe->description = $request->description;
        $recipe->ingredients = $request->ingredients;
        $recipe->link = $request->link;
        $recipe->save();

        $recipe->categories()->sync($request->categories);

        return redirect()->route('home')->with('status', 'Recipe Updated');
    }

    public function destroy($id)//izdzēš recepti
    {
        $recipe = Recipe::findOrFail($id);
        File::delete(storage_path('app/public/' . $recipe->image));
        $recipe->categories()->detach();
        $recipe->delete();

        return redirect()->route('home')->with('status', 'Recipe Deleted');
    }

    public function search(Request $request)//meklē recepti.
    {
        $query = $request->input('query');
        $recipes = Recipe::where('name', 'like', "%$query%")
                          ->orWhere('description', 'like', "%$query%")
                          ->orWhere('ingredients', 'like', "%$query%")
                          ->orWhere('link', 'like', "%$query%")
                          ->get();

        return view('recipe.index', compact('recipes'));
    }

    public function getRandomRecipe()//izvada nejaušu recepti.
    {
        $randomRecipe = Recipe::inRandomOrder()->first();
        return response()->json(['recipe' => $randomRecipe]);
    }
}
