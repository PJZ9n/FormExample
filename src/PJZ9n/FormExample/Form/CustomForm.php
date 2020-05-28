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
use pocketmine\Player;
use pocketmine\utils\TextFormat;

/**
 * Class CustomForm
 * 自由に様々な要素を配置できるフォーム
 */
class CustomForm implements Form
{
    public function handleResponse(Player $player, $data): void
    {
        if ($data === null) {
            //フォームが閉じられた場合
            $player->sendMessage(TextFormat::RED . "フォームが閉じられました。");
            return;//ここで処理を終了
        }
        $knowTwitter = $data[1];
        $tweetCount = $data[2];
        $likeUser = $data[3];
        $blockUser = $data[4];
        $dislikeUser = $data[5];
        if ($knowTwitter) {
            $player->sendMessage("あなたはTwitterを知っています！");
        } else {
            $player->sendMessage("あなたはTwitterを知りません！");
        }
        if ($tweetCount >= 500) {
            //500回を超えていたら
            $player->sendMessage("あなたはTwitter廃人ですね！");
        } else {
            $player->sendMessage("あなたはTwitter廃人ではありません！");
        }
        $likeUserList = [
            "@github",
            "@TwitterJP",
            "@pjz9n",
            "@Twitter",
        ];
        $player->sendMessage("あなたは{$likeUserList[$likeUser]}が好きです！");
        $blockUserList = [
            "@github",
            "@TwitterJP",
            "@pjz9n",
            "@Twitter",
        ];
        $player->sendMessage("あなたは{$blockUserList[$blockUser]}をブロックしました！");
        $player->sendMessage("あなたは{$dislikeUser}が嫌いです！");
    }
    
    public function jsonSerialize()
    {
        return [
            "type" => "custom_form",
            "title" => "CustomFormの例",
            "content" => [
                [
                    "type" => "label",//文字を表示する
                    "text" => "テキスト12345テスト",
                ],
                [
                    "type" => "toggle",//トグルボタン
                    "text" => "Twitterを知っていますか？",
                    "default" => false,//デフォルト値(任意)
                ],
                [
                    "type" => "slider",//スライダー(数字を選択させる)
                    "text" => "本日のツイート数",
                    "min" => 0,//最低値
                    "max" => 1000,//最大値
                    "step" => 10,//目盛り(任意)
                    "default" => 500,//デフォルト値(任意)
                ],
                [
                    "type" => "step_slider",//スライダー(任意の値を選択させる)
                    "text" => "好きなユーザー",
                    "steps" => [
                        "@github",
                        "@TwitterJP",
                        "@pjz9n",
                        "@Twitter",
                    ],//選択できる値
                    "default" => 2,//デフォルト値(任意)
                ],
                [
                    "type" => "dropdown",//ドロップダウン(任意の値を選択させる)
                    "text" => "ブロックしたいユーザー",
                    "options" => [
                        "@github",
                        "@TwitterJP",
                        "@pjz9n",
                        "@Twitter",
                    ],//選択できる値
                    "default" => 3,//デフォルト値(任意)
                ],
                [
                    "type" => "input",//なにかを入力させる
                    "text" => "嫌いなユーザー",
                    "placeholder" => "ここに入力してください",//プレースホルダー(任意)
                    "default" => "@TwitterJP",//デフォルト値(任意)
                ],
            ],
        ];
    }
}