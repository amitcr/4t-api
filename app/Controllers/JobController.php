<?php
namespace App\Controllers;

use App\Models\JobModel;
use App\Core\Request;

class JobController
{
    // Example: GET /api/jobs
    public function index(Request $request) {
        // Extract query params from request
        $orderBy   = $request->get('order_by', 'id');   // default order by id
        $order     = $request->get('order', 'asc');     // default ASC
        $limit     = (int) $request->get('limit', 10);  // default 10 records
        $page      = (int) $request->get('page', 1);    // default first page
        $offset    = ($page - 1) * $limit;


        // Get total rows
        $totalRows = JobModel::count();

        // Get paginated records
        $records = JobModel::orderBy($orderBy, $order)
            ->skip($offset)
            ->take($limit)
            ->get();

        // Prepare response with extra params
        return [
            'total_rows' => $totalRows,
            'page'       => $page,
            'limit'      => $limit,
            'total_pages'=> ceil($totalRows / $limit),
            // 'order_by'   => $orderBy,
            // 'order'      => $order,
            'data' => $records,
        ];
    }

    // Example: GET /api/jobs/{id}
    public function show(Request $request, $id) {
        return JobModel::find($id); // find by PK
    }

    // Example: POST /api/jobs
    public function store(Request $request) {
        $data = $request->all();
        pr($data); die;
        return JobModel::create($data);
    }

    // Example: PUT /api/jobs/{id}
    public function update($request, $id) {
        $data = $request->all();
        $job = JobModel::find($id);
        if ($job) {
            $job->update($data);
        }
        return $job;
    }

    // Example: DELETE /api/jobs/{id}
    public function destroy($id) {
        $job = JobModel::find($id);
        if ($job) {
            $job->delete();
        }
        return ['deleted' => (bool) $job];
    }
}
