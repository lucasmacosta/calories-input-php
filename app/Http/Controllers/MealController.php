<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Meal;
use App\Http\Requests\StoreMealPost;
use Illuminate\Support\Facades\DB;

class MealController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:create,App\Meal,user', [ 'only' => [ 'index', 'create', 'store' ] ]);
        $this->middleware('can:update,meal', [ 'only' => [ 'edit', 'update', 'destroy' ] ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $this->validate($request, [
            'date_from' => 'date_format:"Y-m-d"',
            'date_to' => 'date_format:"Y-m-d"',
            'time_from' => 'date_format:"H:i"',
            'time_to' => 'date_format:"H:i"',
        ]);

        $meals_query = $user->meals();

        if ($request->has('date_from')) {
            $meals_query->where(DB::Raw('DATE(date)'), '>=', $request->input('date_from'));
        }

        if ($request->has('date_to')) {
            $meals_query->where(DB::Raw('DATE(date)'), '<=', $request->input('date_to'));
        }

        if ($request->has('time_from')) {
            $meals_query->where(DB::Raw('TIME(date)'), '>=', $request->input('time_from'));
        }

        if ($request->has('time_to')) {
            $meals_query->where(DB::Raw('TIME(date)'), '<=', $request->input('time_to'));
        }

        $meals = $meals_query->orderBy('date', 'desc')->get();

        $meals_groups = $meals->groupBy(function ($meal, $key) {
            return $meal->date->toDateString();
        })->map(function ($mealsGroup, $key) {
            return [
                'total_calories' => $mealsGroup->sum('calories'),
                'meals' => $mealsGroup,
            ];
        });

        return view('meals.index')
            ->with('user', $user)
            ->with('meals_groups', $meals_groups)
            ->with('query_params', $request->only(['date_from', 'date_to', 'time_from', 'time_to']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('meals.create')
            ->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMealPost $request, User $user)
    {
        $user->meals()->create($request->all());

        return redirect()->route('users.meals.index', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Meal $meal)
    {
        return view('meals.edit')
            ->with('user', $user)
            ->with('meal', $meal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMealPost $request, User $user, Meal $meal)
    {
        $meal->update($request->all());

        return redirect()->route('users.meals.index', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Meal $meal)
    {
        $meal->delete();

        return redirect()->route('users.meals.index', $user);
    }
}
