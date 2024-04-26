<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(
        private RoleInterface $roleRepository
    ){}

    
    public function index()
    {
        $response = $this->roleRepository->all();
        return !$response['success'] ? 
            $this->sendError($response['message'], Response::HTTP_INTERNAL_SERVER_ERROR):
            $this->sendResponse($response['message'], [
                'roles' => RoleResource::collection($response['roles'])
            ]);
    }

    public function show($id){
        $response = $this->roleRepository->getRole($id);
        return !$response['success'] ? 
            $this->sendError($response['message'], Response::HTTP_NOT_FOUND) :
            $this->sendResponse($response['message'], [
                'role' => new RoleResource($response['role'])
            ]);
    }

    public function store(CreateRoleRequest $request)
    {
        $response = $this->roleRepository->createRole($request);
        return !$response['success'] ? 
            $this->sendError($response['message'], Response::HTTP_INTERNAL_SERVER_ERROR):
            $this->sendResponse($response['message'], [
                'role' => new RoleResource($response['role'])
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request)
    {
        $response = $this->roleRepository->updatePermissions($request);
        return !$response['success'] ?
            $this->sendError($response['message'], Response::HTTP_INTERNAL_SERVER_ERROR) : 
            $this->sendResponse($response['message'],[
                'role' => new RoleResource($response['role'])
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $response = $this->roleRepository->destroyRole($id);
        return !$response['success'] ?
            $this->sendError($response['message'], Response::HTTP_NOT_FOUND) : 
            $this->sendResponse($response['message']);
    }
}
