<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // Insert task dan tags baru
    public function insert(StoreItemRequest $request)
    {
        $raw = $request->input('item');

        $mapping = $this->_mapping($raw);

        $task = new Task();
        $task->name = $mapping['taskName'];
        $task->save();

        $tags = explode(',', $mapping['tagString']);

        foreach ($tags as $tagName) {
            $tagName = trim($tagName);
            if (!empty($tagName)) {
                Tag::create([
                    'tag_name' => $tagName,
                    'task_id' => $task->id,
                ]);
            }
        }

        return to_route('dashboard');
    }

    // Update task dan tags terkait
    public function update(Request $request, $id)
    {
        $request->validate([
            'item' => 'required|string',
        ]);

        $raw = $request->input('item');
        $mapping = $this->_mapping($raw);

        $task = Task::findOrFail($id);
        $task->name = $mapping['taskName'];
        $task->save();

        // Hapus tag lama, kemudian buat tag baru
        Tag::where('task_id', $task->id)->delete();

        $tags = explode(',', $mapping['tagString']);
        foreach ($tags as $tagName) {
            $tagName = trim($tagName);
            if (!empty($tagName)) {
                Tag::create([
                    'tag_name' => $tagName,
                    'task_id' => $task->id,
                ]);
            }
        }

        return to_route('dashboard');
    }

    // Delete task dan tags terkait (cascade delete tags harusnya di model)
    public function delete($id)
    {
        $to_delete = Task::where('id', $id)->firstOrFail();
        $to_delete->delete();

        return to_route('dashboard');
    }

    // Private helper untuk parsing input
    private function _mapping($raw)
    {
        $parts = explode('|', $raw);
        $taskName = trim($parts[0]);
        $tagString = isset($parts[1]) ? trim($parts[1]) : '';

        return [
            'taskName' => $taskName,
            'tagString' => $tagString,
        ];
    }
}
