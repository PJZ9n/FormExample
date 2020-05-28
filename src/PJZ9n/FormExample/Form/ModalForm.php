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

/**
 * Class ModalForm
 * ボタンが2つあるフォーム
 */
class ModalForm implements Form
{
    public function handleResponse(Player $player, $data): void
    {
        if ($data) {
            //ボタン1(はい)が押されたときの処理
            $player->chat("こんにちは！");//プレイヤーにチャットさせる
        } else {
            //ボタン2(いいえ)が押されたときの処理
            $player->sendMessage("挨拶をしませんでした...");
        }
    }
    
    public function jsonSerialize()
    {
        return [
            "type" => "modal",
            "title" => "ModalFormの例",
            "content" => "挨拶しますか？",
            "button1" => "はい",//ボタン1に表示される文字
            "button2" => "いいえ",//ボタン2に表示される文字
        ];
    }
}