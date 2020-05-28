<?php

/**
 * Copyright (c) 2020 PJZ9n.
 *
 * This file is part of FormExample.
 *
 * FormExample is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * FormExample is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with FormExample. If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace PJZ9n\FormExample\Form;

use pocketmine\form\Form;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

/**
 * Class NormalForm
 * ボタンを任意の数置ける通常のフォーム
 */
class NormalForm implements Form
{
    public function handleResponse(Player $player, $data): void
    {
        if ($data === null) {
            //フォームが閉じられた場合
            $player->sendMessage(TextFormat::RED . "フォームが閉じられました。");
            return;//ここで処理を終了
        }
        switch ($data) {
            case 0:
                //日本語で挨拶する
                $player->chat("こんにちは！");
                break;
            case 1:
                //英語で挨拶する
                $player->chat("Hello!");
                break;
            case 2:
                //りんごを取得する
                $inventory = $player->getInventory();
                $item = Item::get(Item::APPLE, 0, 1);
                if ($inventory->canAddItem($item)) {//アイテムが追加可能か調べる
                    $player->getInventory()->addItem($item);//アイテムを追加する
                    $player->sendMessage("りんごを取得しました！");
                } else {
                    $player->sendMessage(TextFormat::RED . "アイテムを追加できませんでした。");
                }
                break;
            case 3:
                //テストボタン
                $player->sendMessage("テストボタンが押されました。");
                break;
        }
    }
    
    public function jsonSerialize()
    {
        return [
            "type" => "form",
            "title" => "Formの例",
            "content" => "選択してください！",
            "buttons" => [
                [
                    "text" => "日本語で挨拶する",
                ],
                [
                    "text" => "英語で挨拶する",
                ],
                [
                    "text" => "りんごを取得する",
                    "image" => [
                        "type" => "path",//リソースパックのパスを使用する
                        "data" => "textures/items/apple",//リソースパックでのパス
                    ],
                ],
                [
                    "text" => "テストボタン",
                    "image" => [
                        "type" => "url",//URLの画像を使用する
                        "data" => "https://via.placeholder.com/50",//画像のURL
                    ],
                ],
            ],
        ];
    }
}