<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\StoreUserRequest;
use App\Http\Requests\API\v1\UpdateUserRequest;
use App\Http\Resources\API\v1\UserResource;
use App\Repository\Interface\RepoInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * How many rows you want in each pagination page.
     *
     * @var int
     */
    const PER_PAGE = 10;

    /**
     * User repo instance.
     * 
     * @param \App\Repository\Interface\RepoInterface $userRepo
     */
    protected RepoInterface $userRepo;

    /**
     * Class initialization.
     * 
     * @param \App\Repository\Interface\RepoInterface $repoInstance
     * 
     * @return void
     */
    public function __construct(RepoInterface $repoInstance)
    {
        $this->userRepo = $repoInstance;
    }

    /**
     * List paginated users.
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return void
     */
    public function index(Request $request)
    {
        return UserResource::collection($this->userRepo->get(self::PER_PAGE));
    }

    /**
     * Store a user.
     * 
     * @param \App\Http\Requests\API\v1\StoreUserRequest $request
     * 
     * @return Json
     */
    public function store(StoreUserRequest $request)
    {
        $this->userRepo->create($request->only('name', 'username', 'password'));

        return response()->json(['message' => __('Created successfully!')], Response::HTTP_CREATED);
    }

    /**
     * Display a user by ID.
     * 
     * @param int $id
     * 
     * @return Json
     */
    public function show(int $id)
    {
        return new UserResource($this->userRepo->find($id));
    }

    /**
     * Update a user by ID.
     * 
     * @param \App\Http\Requests\API\v1\UpdateUserRequest $request
     * @param int $id
     * 
     * @return Json
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        $this->userRepo->update($id, $request->only('name', 'username', 'password'));

        return response()->json(['message' => __('Updated successfully!')], Response::HTTP_OK);
    }

    /**
     * Remove a user by ID.
     * 
     * @param int $id
     * 
     * @return Json
     */
    public function destroy(int $id)
    {
        $this->userRepo->delete($id);

        return response()->json(['message' => __('Deleted successfully!')], Response::HTTP_OK);
    }
}
