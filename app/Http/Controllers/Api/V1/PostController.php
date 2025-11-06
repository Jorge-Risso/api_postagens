<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Services\PostService;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Exception;

class PostController extends Controller
{
    protected  $service;

    public function __construct(PostService $service)
    {
         $this->middleware('auth:api')->only(['store', 'update', 'destroy']);
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $perPage = (int)$request->get('per_page',10);
        $posts = $this->service->list($perPage);

        if ($posts->isEmpty()) {
            return response()->json([
            'success' => true,
            'message' => 'Nenhum post encontrado',
            'data' => [],
            'meta' => [
                'current_page' => $posts->currentPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total()
            ]
            ], 200);
        }

    return response()->json([
            'success'=>true,
            'message'=>'Lista de posts',
            'data' => PostResource::collection($posts)->resolve(),
            'meta' => [
                'current_page'=>$posts->currentPage(),
                'per_page'=>$posts->perPage(),
                'total'=>$posts->total()
            ]
        ], 200);

    }

    public function store(PostStoreRequest $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $data = array_merge($request->validated(), ['user_id'=>$user->id]);
            $post = $this->service->create($data);
            return response()->json(['success'=>true,'message'=>'Post criado','data'=> new PostResource($post)], 201);
        } catch (Exception $e) {
            return response()->json(['success'=>false,'message'=>'Erro ao criar post','error'=>$e->getMessage()],500);
        }
    }

    public function show($id)
    {
        $post = $this->service->find($id);
        if (!$post) return response()->json(['success'=>false,'message'=>'Post não encontrado'],404);
        return response()->json(['success'=>true,'data'=> new PostResource($post)],200);
    }

    public function update(PostUpdateRequest $request, $id)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $post = $this->service->find($id);
            if (!$post) return response()->json(['success'=>false,'message'=>'Post não encontrado'],404);
            if ($post->user_id !== $user->id) return response()->json(['success'=>false,'message'=>'Proibido'],403);
            $updated = $this->service->update($id, $request->validated());
            return response()->json(['success'=>true,'message'=>'Atualizado','data'=> new PostResource($updated)],200);
        } catch (Exception $e) {
            return response()->json(['success'=>false,'message'=>'Erro ao atualizar','error'=>$e->getMessage()],500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $post = $this->service->find($id);
            if (!$post) return response()->json(['success'=>false,'message'=>'Post não encontrado'],404);
            if ($post->user_id !== $user->id) return response()->json(['success'=>false,'message'=>'Proibido'],403);
            $this->service->delete($id);
            return response()->json(['success'=>true,'message'=>'Deletado'],200);
        } catch (Exception $e) {
            return response()->json(['success'=>false,'message'=>'Erro ao deletar','error'=>$e->getMessage()],500);
        }
    }
}
