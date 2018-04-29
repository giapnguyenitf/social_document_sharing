<?php

namespace App\Http\Controllers\User;

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
        $newestDocuments = $this->documentRepository->getNewests();
        $keyword = $request->keyword;
        $searchBy = $request->category;

        if ($searchBy == config('settings.search.by_name')) {
            $documents = $this->documentRepository->searchByName($keyword);
        } else {
            $documents = $this->documentRepository->searchByCategory($keyword, $searchBy);
        }

        return view('user.pages.search', compact('documents', 'keyword', 'newestDocuments'));
    }
}
