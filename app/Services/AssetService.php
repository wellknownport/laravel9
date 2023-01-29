<?php

declare(strict_types=1);

namespace App\Services;

use App\Entities\AssetEntity;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class AssetService
{
    /**
     * @param int $asset_id
     * @return \App\Entities\AssetEntity|null
     */
    public function findById(int $asset_id): \App\Entities\AssetEntity|null
    {
        $asset = DB::table('assets')->find($asset_id);
        if (!empty($asset)) {
            $asset = new AssetEntity($asset);
        }

        return $asset;
    }


    public function saveAndRelation(int $post_id, UploadedFile $file): void
    {
        $row = DB::table('asset_post')
            ->select([
                'asset_post.post_id',
                'asset_post.asset_id',
                'assets.type',
            ])
            ->leftJoin('assets', 'asset_post.asset_id', '=', 'assets.id')
            ->where('asset_post.post_id', '=', $post_id)
            ->where('assets.type', '=', \App\Define\AssetType::IMAGE_JPEG)
            ->first();

        $now = Carbon::now()->format('Y-m-d H:i:s');
        if ($row === null) {
            $result = DB::table('assets')->insertGetId([
                'content'    => file_get_contents($file->getRealPath()),
                'type'       => \App\Define\AssetType::IMAGE_JPEG,
                'updated_at' => $now,
                'created_at' => $now,
            ]);

            DB::table('asset_post')
                ->insert([
                    'post_id'  => $post_id,
                    'asset_id' => $result,
                ]);
        } else {
            DB::table('assets')
                ->where('id', $row->asset_id)
                ->update([
                    'content'    => file_get_contents($file->getRealPath()),
                    'updated_at' => $now,
                ]);
        }
    }
}
