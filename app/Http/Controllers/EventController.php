<?php

namespace App\Http\Controllers;

use Throwable;
use Inertia\Inertia;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('management/events/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('management/events/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:events,name',
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'start_date_event' => 'nullable|date',
            'expired_date_event' => 'nullable|date',
            'start_date_application' => 'nullable|date',
            'end_date_application' => 'nullable|date',
            'first_contact' => 'nullable|string|max:255',
            'first_phone' => 'nullable|string|max:255',
        ]);

        try {
            // Tạo sự kiện
            Event::create($data);

            // Thành công → trả về trang index với flash success
            return redirect()
                ->route('management.events.index')
                ->with('success', 'Sự kiện đã được tạo thành công');

        } catch (Throwable $e) {
            
            // Thất bại → quay lại với flash error
            return redirect()
                ->back()
                ->with('error', 'Đã có lỗi xảy ra, vui lòng thử lại sau.' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
