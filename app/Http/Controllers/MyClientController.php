<?php

namespace App\Http\Controllers;

use App\Models\MyClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;

class MyClientController extends Controller
{
    public function index()
    {
        $clients = MyClient::whereNull('deleted_at')->get();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function edit($id)
    {
        $client = MyClient::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'slug' => 'required|string|max:100|unique:my_clients,slug',
            'is_project' => 'required|in:0,1',
            'self_capture' => 'required|in:0,1',
            'client_prefix' => 'required|string|max:4',
            'client_logo' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:50',
        ]);

        $data = $request->all();
        if ($request->hasFile('client_logo')) {
            $logoPath = $request->file('client_logo')->store('client_logos', 's3');
            $data['client_logo'] = Storage::disk('s3')->url($logoPath);
        }

        $data['created_at'] = now();
        $client = MyClient::create($data);

        Redis::set("client:{$client->id}", json_encode($client));

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    public function show($id)
    {
        $cachedClient = Redis::get("client:{$id}");
        if ($cachedClient) {
            $client = json_decode($cachedClient);
            return view('clients.show', compact('client'));
        }

        $client = MyClient::findOrFail($id);

        Redis::set("client:{$id}", json_encode($client));

        return view('clients.show', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = MyClient::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:250',
            'is_project' => 'required|in:0,1',
            'self_capture' => 'required|in:0,1',
            'client_prefix' => 'required|string|max:4',
            'client_logo' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:50',
        ]);

        if ($request->hasFile('client_logo')) {
            Storage::disk('s3')->delete(parse_url($client->client_logo, PHP_URL_PATH));

            $logoPath = $request->file('client_logo')->store('client_logos', 's3');
            $client->client_logo = Storage::disk('s3')->url($logoPath);
        }

        $client->update($request->all());

        Redis::del("client:{$id}");
        Redis::set("client:{$id}", json_encode($client));

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy($id)
    {
        $client = MyClient::findOrFail($id);
        $client->update(['deleted_at' => now()]);

        Redis::del("client:{$id}");

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}