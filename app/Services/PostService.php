<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\PostStoreRequest;
use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class PostService
{
    public function getPosts(int $num = 5)
    {
        $asset = DB::table('asset_post')
            ->select([DB::raw('MAX(asset_post.asset_id) AS `asset_id`'), DB::raw('MAX(asset_post.post_id) AS `post_id`')])
            ->leftJoin('assets', 'asset_post.asset_id', '=', 'assets.id')
            ->where('assets.type', \App\Define\AssetType::IMAGE_JPEG)
            ->groupBy('asset_post.post_id');

        //dd($asset->toSql());

        /**
         * @var \Illuminate\Pagination\LengthAwarePaginator $posts
         */
        $posts = DB::table('posts')
            ->select(['posts.id', 'posts.content', 'posts.release_at', 'asset_post.asset_id'])
            ->leftJoinSub($asset, 'asset_post', function (JoinClause $join) {
                $join->on('posts.id', '=', 'asset_post.post_id');
            })
            ->orderBy('release_at', 'DESC')
            ->paginate($num);

        return $posts;
    }

    /**
     * @param int $post_id
     * @return \App\Entities\PostEntity|\Illuminate\Database\Query\Builder|mixed
     */
    public function findById(int $post_id)
    {
        $post = null;

        $row = DB::table('posts')
            ->select([
                'posts.*', 'asset_post.asset_id'
            ])
            ->leftJoin('asset_post', 'asset_post.post_id', '=', 'posts.id')
            ->where('posts.id', '=', $post_id)
            ->first();

        if (!empty($row)) {
            $post = new \App\Entities\PostEntity($row);
            $post->setAssetId($row->asset_id);
        }

        return $post;
    }

    /**
     * @param \App\Http\Requests\PostStoreRequest $request
     * @return int|bool
     */
    public function save(PostStoreRequest $request): int|bool
    {
        $entity = new \App\Entities\PostEntity($request->all());
        $now    = Carbon::now()->format('Y-m-d H:i:s');

        if ((int)$entity->id === 0) {
            $entity->created_at = $now;
            $entity->updated_at = $now;
            $result             = DB::table('posts')->insertGetId($entity->toArray(exclude: ['id']));
            $entity->id         = $result;
        } else {
            $entity->updated_at = $now;
            $result             = DB::table('posts')
                ->where('id', $entity->id)
                ->update($entity->toArray(exclude: ['id', 'created_at']));
        }

        /**
         *
         */
        $photo = $request->file('photo');
        if ($photo !== null) {
            /**
             * @var AssetService $service
             */
            $service = app()->make('AssetService');
            $service->saveAndRelation((int)$entity->id, $photo);
        }

        return $result;
    }

    public function delete(int $id): bool
    {
        $result = DB::transaction(function () use ($id) {
            $result    = false;
            $results   = [];

            // 投稿削除
            $results[] = DB::table('posts')->where('id', '=', $id)->delete();

            // 関連データの削除
            $row = DB::table('asset_post')->where('post_id', '=', $id)->first();
            if (!empty($row)) {
                $results[] = DB::table('asset_post')->where('post_id', '=', $id)->delete();
                $results[] = DB::table('assets')->where('id', '=', $row->asset_id)->delete();
            }

            if (array_sum($results) > 0) {
                $result = true;
            }

            return $result;
        });

        return $result;
    }
}
