<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;
use phpDocumentor\Reflection\Types\This;

class PizzaController extends Controller
{
    public function __construct()

    {
        $this->middleware('auth')->except(['index', 'show']);
    }


    public function index()
    {
        $pizzas = Pizza::orderBy('name')->get();
        return view(
            'pizzas/index',
            [
                'pizzas' => $pizzas

            ]
        );
    }
    public function create()
    {

        return view('pizzas/create');
    }

    public function show($id)
    {
        $pizza = Pizza::findorfail($id);
        return view('pizzas/moreinfo/show', ['pizza' => $pizza]);
    }
    public function store()
    {
        $pizza = new Pizza();
        $pizza->name = request('name');
        $pizza->type = request('type');
        $pizza->base = request('base');
        $pizza->toppings = request('toppings');

        $pizza->save();
        return redirect('/pizzas')->with('mssg', 'thanks for ordering');
    }

    public function destroy($id)
    {

        $pizza = Pizza::findOrFail($id);
        $pizza->delete();

        return redirect('/pizzas');
    }
}
