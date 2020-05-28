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

namespace PJZ9n\FormExample;

use PJZ9n\FormExample\Form\ModalForm;
use PJZ9n\FormExample\Form\NormalForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Main extends PluginBase
{
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if (!$sender instanceof Player) {
            $sender->sendMessage(TextFormat::RED . "このコマンドはプレイヤーから実行してください。");
            return true;
        }
        if (count($args) < 1) {
            return false;
        }
        switch ($args[0]) {
            case "modal":
                $form = new ModalForm();//ModalFormのオブジェクトを生成
                $sender->sendForm($form);//送信する
                return true;
            case "form":
                $form = new NormalForm();//NormalFormのオブジェクトを生成
                $sender->sendForm($form);
                return true;
            case "custom":
                //
                return true;
        }
        return false;
    }
}