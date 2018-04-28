<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\DocumentRepositoryInterface;

class SearchController extends Controller
{
    protected $documentRepository;

    public function __construct(DocumentRepositoryInterface $documentRepository)
    {
        $this->documentRepository = $documentRepository;
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $keyword = $request->keyword;
            $searchBy = $request->searchBy;

            if ($searchBy == config('settings.search.by_name')) {
                $results = $this->documentRepository->searchByName($keyword)->take(6);
            } else {
                $results = $this->documentRepository->searchByCategory($keyword, $searchBy)->take(6);
            }

            return response()->json([
                'status' => true,
                'data' => $results,
            ]);
        }

        return response()->json([
            'status' => false,
        ]);
    }
}
