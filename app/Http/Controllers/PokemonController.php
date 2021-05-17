<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws ValidationException
     */
    public function index(Request $request): JsonResponse
    {
        $rules = [
            'q' => 'string',
            'page' => 'integer',
            'per_page' => 'integer|max:100',
            'num' => 'integer',
            'name' => 'string',
            'type_1' => 'string|in:Grass,Fire,Water,Bug,Normal,Poison,Electric,Ground,Fairy,Fighting,Psychic,Rock,Ghost,Ice,Dragon,Dark,Steel,Flying',
            'type_2' => 'string|in:Grass,Fire,Water,Bug,Normal,Poison,Electric,Ground,Fairy,Fighting,Psychic,Rock,Ghost,Ice,Dragon,Dark,Steel,Flying',
            'total' => 'integer',
            'hp' => 'integer',
            'attack' => 'integer',
            'defense' => 'integer',
            'sp_atk' => 'integer',
            'sp_def' => 'integer',
            'speed' => 'integer',
            'generation' => 'integer',
            'legendary' => 'boolean'
        ];

        $invalidKeys = array_keys(array_diff_key($request->all(), $rules));

        $this->validate($request, $rules);

        if (!empty($invalidKeys)) {
            return response()->json(['message' => 'invalid parameter', 'parameters' => $invalidKeys], 400);
        }

        $params = $request->all();

        $pokemon = DB::table('pokemons');

        foreach ($params as $paramName => $param) {
            if ($paramName !== 'q' && $paramName !== 'page' && $paramName !== 'per_page') {
                $pokemon->where($paramName, '=', $param);
            }
        }

        $q = strtolower($request->get('q'));

        if (!empty($q)) {
            $pokemon->where(function($query) use ($q) {
                $query->whereRaw('lower(name) LIKE ?', ['%' . $q . '%'])
                    ->orWhereRaw('lower(type_1) LIKE ?', ['%' . $q . '%'])
                    ->orWhereRaw('lower(type_2) LIKE ?', ['%' . $q . '%']);
            });
        }

        $perPage = $request->get('per_page', 100);

        $page = $request->get('page', 0);

        $offset = $page * $perPage;

        $pokemon->limit($perPage);
        $pokemon->offset($offset);

        $result = $pokemon->get()->toArray();

        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $rules = [
            'num' => 'required|integer',
            'name' => 'required|string|max:150',
            'type_1' => 'required|string|in:Grass,Fire,Water,Bug,Normal,Poison,Electric,Ground,Fairy,Fighting,Psychic,Rock,Ghost,Ice,Dragon,Dark,Steel,Flying',
            'type_2' => 'string|in:Grass,Fire,Water,Bug,Normal,Poison,Electric,Ground,Fairy,Fighting,Psychic,Rock,Ghost,Ice,Dragon,Dark,Steel,Flying',
            'total' => 'integer',
            'hp' => 'integer',
            'attack' => 'integer',
            'defense' => 'integer',
            'sp_atk' => 'integer',
            'sp_def' => 'integer',
            'speed' => 'integer',
            'generation' => 'integer',
            'legendary' => 'boolean'
        ];

        $invalidKeys = array_keys(array_diff_key($request->json()->all(), $rules));

        $this->validate($request, $rules);

        if (!empty($invalidKeys)) {
            return response()->json(['message' => 'invalid parameter', 'parameters' => $invalidKeys], 400);
        }

        $params = $request->json()->all();

        data_set(
            $params,
            'uuid',
            md5(data_get($params, 'num') . data_get($params, 'name'))
        );

        $pokemon = Pokemon::create($params);

        return response()->json($pokemon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $uuid
     *
     * @return JsonResponse
     *
     * @throws ValidationException
     */
    public function update(Request $request, string $uuid): JsonResponse
    {
        $rules = [
            'num' => 'integer',
            'name' => 'string||max:150',
            'type_1' => 'string|in:Grass,Fire,Water,Bug,Normal,Poison,Electric,Ground,Fairy,Fighting,Psychic,Rock,Ghost,Ice,Dragon,Dark,Steel,Flying',
            'type_2' => 'string|in:Grass,Fire,Water,Bug,Normal,Poison,Electric,Ground,Fairy,Fighting,Psychic,Rock,Ghost,Ice,Dragon,Dark,Steel,Flying',
            'total' => 'integer',
            'hp' => 'integer',
            'attack' => 'integer',
            'defense' => 'integer',
            'sp_atk' => 'integer',
            'sp_def' => 'integer',
            'speed' => 'integer',
            'generation' => 'integer',
            'legendary' => 'boolean'
        ];

        $invalidKeys = array_keys(array_diff_key($request->json()->all(), $rules));

        $this->validate($request, $rules);

        if (!empty($invalidKeys)) {
            return response()->json(['message' => 'invalid parameter', 'parameters' => $invalidKeys], 400);
        }

        $pokemon = Pokemon::findOrFail($uuid);

        $pokemon->update($request->json()->all());

        return response()->json($pokemon);
    }

    /**
     * Display the specified resource.
     *
     * @param $uuid
     * @return JsonResponse
     */
    public function show($uuid): JsonResponse
    {
        return response()->json(Pokemon::findOrFail($uuid)->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $uuid
     * @return JsonResponse
     */
    public function destroy(string $uuid): JsonResponse
    {
        $pokemon = Pokemon::findOrFail($uuid);

        $name = $pokemon->name;

        $pokemon->delete();

        return response()->json(['message' => 'pokemon ' . $name . ' deleted']);
    }
}
