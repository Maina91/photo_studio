<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Client;
use App\LeadSource;
use App\ReferralPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\MassDestroyClientRequest;


class ClientsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $query = Client::query()->select(sprintf('%s.*', (new Client)->table));
            $query = Client::leftJoin('referral_points', 'clients.id', '=', 'referral_points.client_id')
                ->select(
                    'clients.*',
                    \DB::raw('COALESCE(SUM(referral_points.points), 0) as total_referral_points')
                )
                ->groupBy('clients.id');
            $table = Datatables::of($query);


            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'client_show';
                $editGate      = 'client_edit';
                $deleteGate    = 'client_delete';
                $crudRoutePart = 'clients';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->addColumn('referral_points', function ($row) {
                return $row->total_referral_points ? $row->total_referral_points : 0;
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.clients.index');
    }

    public function create()
    {
        abort_if(Gate::denies('client_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $leadSources = LeadSource::all();
        $clients = Client::all();
        return view('admin.clients.create', compact('clients', 'leadSources'));
    }

    public function store(StoreClientRequest $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:clients',
            'lead_source_id' => 'nullable|exists:lead_sources,id',
            'referred_by' => 'nullable|exists:clients,id',
        ]);

        $client = Client::create($validatedData);
        if ($client->referred_by) {
            ReferralPoint::create([
                'client_id' => $client->referred_by,
                'points' => 1,
            ]);
        }

        flash()->success('Client created successfully.');
        return redirect()->route('admin.clients.index');
    }

    public function edit(Client $client)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.clients.edit', compact('client'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->all());

        return redirect()->route('admin.clients.index');
    }

    public function show(Client $client)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.clients.show', compact('client'));
    }

    public function destroy(Client $client)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientRequest $request)
    {
        Client::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
