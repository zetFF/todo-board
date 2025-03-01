<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Todo::query();
            
            // Filter berdasarkan pencarian
            if ($request->has('search')) {
                $query->where('title', 'like', '%' . $request->search . '%');
            }
            
            // Filter berdasarkan kategori dan prioritas
            if ($request->has('category')) {
                $query->where('category', $request->category);
            }
            if ($request->has('priority')) {
                $query->where('priority', $request->priority);
            }
            
            // Filter berdasarkan status selesai
            if ($request->has('completed')) {
                $query->where('completed', $request->completed === 'true');
            }
            
            // Filter berdasarkan tenggat waktu
            if ($request->has('due')) {
                if ($request->due === 'today') {
                    $query->whereDate('due_date', today());
                } elseif ($request->due === 'upcoming') {
                    $query->whereDate('due_date', '>', today());
                }
            }
            
            // Inisialisasi data analytics
            $analyticsData = [
                'total' => Todo::count(),
                'completed' => Todo::where('completed', true)->count(),
                'pending' => Todo::where('completed', false)->count(),
                'overdue' => Todo::where('due_date', '<', now())
                                ->where('completed', false)
                                ->count(),
                'upcoming' => Todo::where('due_date', '>', now())
                                ->where('completed', false)
                                ->count(),
                'due_today' => Todo::whereDate('due_date', today())
                                ->where('completed', false)
                                ->count(),
                'priority_stats' => [
                    'high' => Todo::where('priority', 'high')->count(),
                    'medium' => Todo::where('priority', 'medium')->count(),
                    'low' => Todo::where('priority', 'low')->count(),
                ]
            ];
            
            // Inisialisasi category stats
            $categoryStats = [
                'personal' => Todo::where('category', 'personal')->count(),
                'work' => Todo::where('category', 'work')->count(),
                'shopping' => Todo::where('category', 'shopping')->count(),
                'others' => Todo::where('category', 'others')->count(),
            ];
            
            // Data untuk Weekly Report
            $weeklyData = null;
            if ($request->view === 'weekly') {
                $startOfWeek = now()->startOfWeek();
                $endOfWeek = now()->endOfWeek();
                
                $weeklyData = Todo::whereBetween('due_date', [
                    $startOfWeek->format('Y-m-d'),
                    $endOfWeek->format('Y-m-d')
                ])->get()->groupBy(function($todo) {
                    return Carbon::parse($todo->due_date)->format('Y-m-d');
                });
            }
            
            // Data untuk Monthly Report
            $monthlyData = null;
            if ($request->view === 'monthly') {
                $startOfMonth = now()->startOfMonth();
                $endOfMonth = now()->endOfMonth();
                
                $monthlyData = Todo::whereBetween('due_date', [
                    $startOfMonth->format('Y-m-d'),
                    $endOfMonth->format('Y-m-d')
                ])->get();
            }
            
            // Data untuk Weekly Progress Chart
            $lastWeek = collect(range(6, 0))->map(function($day) {
                $date = now()->subDays($day);
                return [
                    'date' => $date->format('D'),
                    'completed' => Todo::where('completed', true)
                        ->whereDate('updated_at', $date)
                        ->count()
                ];
            });
            
            // Get todos with pagination
            $todos = $query->latest()->paginate(9);
            
            return view('todos.index', compact(
                'todos', 
                'categoryStats', 
                'weeklyData', 
                'monthlyData', 
                'analyticsData',
                'lastWeek'
            ));
            
        } catch (\Exception $e) {
            \Log::error('Error in TodoController@index: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading todos.');
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'priority' => 'required|in:low,medium,high',
            'category' => 'required|in:personal,work,shopping,others',
            'due_date' => 'required|date',
            'due_time' => 'required',
        ]);

        Todo::create($validatedData);

        return redirect()->route('todos.index')->with('success', 'Todo created successfully!');
    }

    public function update(Request $request, Todo $todo)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'priority' => 'required|in:low,medium,high',
            'category' => 'required|in:personal,work,shopping,others',
            'due_date' => 'required|date',
            'due_time' => 'required',
        ]);

        $todo->update($validatedData);

        return redirect()->route('todos.index')->with('success', 'Todo updated successfully!');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('todos.index')
            ->with('success', 'Todo berhasil dihapus!');
    }

    public function toggle(Todo $todo)
    {
        $todo->update([
            'completed' => !$todo->completed
        ]);

        return back()->with('success', 'Task status updated successfully!');
    }
} 