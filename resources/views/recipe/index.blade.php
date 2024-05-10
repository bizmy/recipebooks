@extends('layout')

@section('title', 'Recipes')

@section('content')
<style>
    body {
        color: white; /* teksta krāsa balta */
    }

    .card-header {
        background-color: #1e2124; /* Tumšāka fona krāsa card galvenēm */
    }

    .table-dark th {
        background-color: #1e2124; /*Tumšāka fona krāsa tabulas galvenēm */
    }

   
    a {
        color: #6cb2eb; /*uzstāda saites teksta krāsu.*/
    }

    #randomRecipeContainer {
        margin-top: 20px;
    }

    #randomRecipeCard {
        background-color: #495057; 
        border-radius: 8px;
        padding: 20px;
        margin-top: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    #randomRecipeTitle {
        color: white;
        font-size: 20px;
        margin-bottom: 10px;
    }

    .randomRecipeDetail {
        color: #ced4da; 
        margin-bottom: 8px;
    }

    
    #randomRecipeLink {
        color: #6cb2eb; 
    }

    #fetchRandomRecipe {
        color: white; /* pogas krāsu uzstāda baltu */
    }
    .card {
  
  width: 100%; / Set width to 100% of its container /
  height: 100vh; / Set height to 100% of viewport height /
 
  
}
</style>

<div class="">
<div class="col">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Recipes</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('recipes.search') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Search recipes...">
                    <button type="submit" class="btn btn-outline-primary">Search</button>
                </div>
            </form>

            <div class="mb-3">
                <a href="{{ url('/') }}" class="btn btn-secondary"><i class="fas fa-home"></i> Home</a>
                <a href="{{ url('recipes/create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Add Recipe</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Ingredients</th>
                            <th>Link</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recipes as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <ul>
                                    @if (is_array($item->ingredients))
                                        @foreach($item->ingredients as $ingredient)
                                            <li>{{ $ingredient }}</li>
                                        @endforeach
                                    @else
                                        <li>{{ $item->ingredients }}</li>
                                    @endif
                                </ul>
                            </td>
                            <td><a href="{{ $item->link }}" target="_blank">{{ $item->link }}</a></td>
                            <td>
                                <img src="{{ asset('storage/' . $item->image) }}" style="max-width: 100px;" alt="Image" class="img-fluid rounded">
                            </td>
                            <td>
                                @if ($item->categories->isNotEmpty())
                                    @foreach ($item->categories as $category)
                                        {{ $category->name }}
                                        @if (!$loop->last), @endif 
                                    @endforeach
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('recipes/'.$item->id.'/edit') }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ url('recipes/'.$item->id.'/delete') }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

           
            <div id="randomRecipeContainer">
                <div id="randomRecipeCard" class="card">
                    <div class="card-header bg-info text-white">
                        <h5 id="randomRecipeTitle">Random Recipe</h5>
                    </div>
                    <div class="card-body">
                        <p class="randomRecipeDetail" id="randomRecipeName"></p>
                        <p class="randomRecipeDetail" id="randomRecipeDescription"></p>
                        <p class="randomRecipeDetail" id="randomRecipeIngredients"></p>
                        <p class="randomRecipeDetail" id="randomRecipeLink"></p>
                    </div>
                </div>
            </div>

            <button id="fetchRandomRecipe" class="btn btn-primary mt-3">Get Random Recipe</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        
        $('#fetchRandomRecipe').click(function() {
            $.get("{{ route('random.recipe') }}", function(data) {
                
                if (data && data.recipe) {
                    var recipe = data.recipe;
                    
                    $('#randomRecipeName').text('Name: ' + recipe.name);
                    $('#randomRecipeDescription').text('Description: ' + recipe.description);
                    $('#randomRecipeIngredients').text('Ingredients: ' + recipe.ingredients);
                    $('#randomRecipeLink').html('Link: <a href="' + recipe.link + '" target="_blank">' + recipe.link + '</a>');
                } else {
                    $('#randomRecipeName').text('No random recipe found.');
                    $('#randomRecipeDescription').text('');
                    $('#randomRecipeIngredients').text('');
                    $('#randomRecipeLink').text('');
                }
            });
        });
    });
</script>
@endsection
