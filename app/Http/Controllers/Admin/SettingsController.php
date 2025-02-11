<?php

namespace App\Http\Controllers\Admin;

use App\PaymentSchedule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentsScheduleShow()
    {
        $schedules = PaymentSchedule::all();

        return view('admin.settings.payments_schedule', compact('schedules'));
    }

    public function paymentScheduleCreate()
    {
        return view('admin.settings.payments_schedule_create');
    }

    public function paymentsScheduleStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'initial_payment_percentage' => 'nullable|integer|min:0|max:100',
            'remaining_payment_days' => 'nullable|integer|min:0',
        ]);

        PaymentSchedule::create($request->all());
        $schedules = PaymentSchedule::all();

        flash()->success('Schedule created successfully.');

        return view('admin.settings.payments_schedule', compact('schedules'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.invoices');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
