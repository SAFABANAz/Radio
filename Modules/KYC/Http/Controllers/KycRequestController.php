<?php

namespace Modules\KYC\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\KYC\Http\Requests\RejectKycRequest;
use Modules\KYC\Http\Requests\StoreKycProfileRequest;
use Modules\KYC\Http\Requests\StoreKycRequest;
use Modules\KYC\Http\Requests\UpdateKycRequest;
use Modules\KYC\Services\KycService;
use Modules\Shared\Base\BaseController;

class KycRequestController extends BaseController
{
    public function __construct(protected KycService $kycService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->kycService->list($request->all()),
            'message' => 'KYC requests retrieved successfully.',
        ]);
    }

    public function store(StoreKycRequest $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->kycService->create($request->validated()),
            'message' => 'KYC request created successfully.',
        ]);
    }

    public function show($kycRequest): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->kycService->find($kycRequest),
            'message' => 'KYC request retrieved successfully.',
        ]);
    }

    public function update(UpdateKycRequest $request, $kycRequest): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->kycService->update($kycRequest, $request->validated()),
            'message' => 'KYC request updated successfully.',
        ]);
    }

    public function submit($kycRequest): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->kycService->submit($kycRequest, request()->user()),
            'message' => 'KYC request submitted for review.',
        ]);
    }

    public function approve($kycRequest): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->kycService->approve($kycRequest, request()->user(), request('comment')),
            'message' => 'KYC request approved successfully.',
        ]);
    }

    public function reject(RejectKycRequest $request, $kycRequest): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->kycService->reject(
                $kycRequest,
                $request->validated()['reason'],
                $request->validated()['comment'] ?? null,
                $request->validated()['required_corrections'] ?? [],
                request()->user()
            ),
            'message' => 'KYC request rejected successfully.',
        ]);
    }

    public function saveProfile(StoreKycProfileRequest $request, $kycRequest): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->kycService->updateProfile($kycRequest, $request->validated()),
            'message' => 'KYC profile saved successfully.',
        ]);
    }
}
