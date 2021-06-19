<?php

namespace App\Http\Controllers\Admin;


use App\Commons\Response;
use App\Http\Controllers\Controller;
use App\Models\TReview;
use Illuminate\Http\Request;

class TReviewController extends Controller
{
    private $review;
    private $response;

    public function __construct(
        TReview $review,
        Response $response
    ) {
        $this->review = $review;
        $this->response = $response;
    }

    public function list()
    {
        $reviews = TReview::query()
            ->with('user')
            ->with('transport')
            ->get();

        return view('admin.treview.review_list', [
            'reviews' => $reviews
        ]);
    }

    public function create()
    {
    }

    public function update()
    {
    }

    public function destroy(Request $request)
    {
        TReview::destroy($request->review_id);
        return back()->with('success', 'Delete review success!');
    }

    public function updateStatus(Request $request)
    {
        $data = $this->validate($request, [
            'status' => 'required',
        ]);

        $model = TReview::find($request->review_id);
        $model->fill($data)->save();

        return $this->response->formatResponse(200, $model, 'Update review status success!');
    }
}
