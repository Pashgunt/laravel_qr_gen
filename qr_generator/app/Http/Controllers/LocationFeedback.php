<?php

namespace App\Http\Controllers;

use App\QR\Contracts\Feedback;
use App\QR\Repositories\CompanyTableHashRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class LocationFeedback extends Controller
{

    private CompanyTableHashRepository $companyTabeHashRepository;

    public function __construct()
    {
        $this->companyTabeHashRepository = new CompanyTableHashRepository();
    }

    public function index(string $hashValue, Feedback $feedback)
    {
        $data = app(Pipeline::class)
            ->send($this->companyTabeHashRepository
                ->checkIssetHashString($hashValue))
            ->through([$feedback])
            ->via('preparePipeline')
            ->thenReturn();
        return view('location.feedback', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
