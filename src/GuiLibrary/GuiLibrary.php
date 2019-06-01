<?php
namespace GuiLibrary;

use muqsit\invmenu\{InvMenu, InvMenuHandler};
use pocketmine\block\Block;
use pocketmine\event\inventory\InventoryCloseEvent;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\inventory\ChestInventory;
use pocketmine\inventory\DoubleChestInventory;
use pocketmine\inventory\transaction\action\CreativeInventoryAction;
use pocketmine\inventory\transaction\action\DropItemAction;
use pocketmine\math\Vector3;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\IntTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\Task;
use pocketmine\tile\Tile;

class GuiLibrary extends PluginBase implements Listener {
    private static $instance = null;

    public static function getInstance() {
        return self::$instance;
    }

    public function onLoad() {
        self::$instance = $this;
    }

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        if (!InvMenuHandler::isRegistered()) {
            InvMenuHandler::register($this);
        }
    }

    //$code == 0 : 작은 상자, $code == 1 : 큰 상자
    public function addWindow(Player $player, string $windowName = "Tele Virtual Inventory", int $code = 0) {
        if ($code == 0) {
            $tile = InvMenu::create(InvMenu::TYPE_CHEST);
            $tile->setName($windowName);
            return [$tile];
        } elseif ($code == 1) {
            $tile = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
            $tile->setName($windowName);
            return [$tile];
        }
    }

    /*private function returnBlock(Player $player, Vector3 $pos, Vector3 $pos_1 = null){
        $block = $player->getLevel()->getBlock($pos);
    if($pos_1 == null){
      $player->getLevel()->sendBlocks([$player], [$block]);
    }
    elseif($pos_1 !== null){
          $block_1 = $player->getLevel()->getBlock($pos_1);
          $player->getLevel()->sendBlocks([$player], [$block, $block_1]);
    }
    }

  public function onPacketReceived(DataPacketReceiveEvent $ev){
        $pk = $ev->getPacket();
        if($pk instanceof LevelSoundEventPacket && ($pk->sound == LevelSoundEventPacket::SOUND_CHEST_OPEN || $pk->sound == LevelSoundEventPacket::SOUND_CHEST_CLOSED)){
      if(isset($this->inv[$ev->getPlayer()->getName()]))
        $ev->setCancelled(true);
        }
    }

  public function onPacketSend(DataPacketSendEvent $ev){
        $pk = $ev->getPacket();
        if($pk instanceof LevelSoundEventPacket && ($pk->sound == LevelSoundEventPacket::SOUND_CHEST_OPEN || $pk->sound == LevelSoundEventPacket::SOUND_CHEST_CLOSED)){
      if(isset($this->inv[$ev->getPlayer()->getName()]))
        $ev->setCancelled(true);
        }
    }*/

    /*public function onClose(InventoryCloseEvent $ev){
        if($ev->getPlayer() instanceof Player){
            if(isset($this->inv[$ev->getPlayer()->getName()])){
        $tile = $ev->getPlayer()->getLevel()->getTile($this->inv[$ev->getPlayer()->getName()]["pos"]);
        $tile->getInventory()->clearAll();
                $this->returnBlock(
                    $ev->getPlayer(),
                  $this->inv[$ev->getPlayer()->getName()]["pos"],
                  $this->inv[$ev->getPlayer()->getName()]["pos_1"]
                );
              unset($this->inv[$ev->getPlayer()->getName()]);
        unset($this->cool[$ev->getPlayer()->getName()]);
            }
        }
    }

    public function onQuit(PlayerQuitEvent $ev){
        if(isset($this->inv[$ev->getPlayer()->getName()])){
      $tile = $ev->getPlayer()->getLevel()->getTile($this->inv[$ev->getPlayer()->getName()]["pos"]);
      $tile->getInventory()->clearAll();
            $this->returnBlock(
                $ev->getPlayer(),
                $this->inv[$ev->getPlayer()->getName()]["pos"],
                $this->inv[$ev->getPlayer()->getName()]["pos_1"]
            );
            unset($this->inv[$ev->getPlayer()->getName()]);
      unset($this->cool[$ev->getPlayer()->getName()]);
        }
    }

  public function onChange(InventoryTransactionEvent $ev){
        foreach($ev->getTransaction()->getActions() as $action){
            if($ev->getTransaction()->getSource() instanceof Player){
                if($action instanceof CreativeInventoryAction) return;
                if($action instanceof DropItemAction) return;
                $player = $ev->getTransaction()->getSource();
                if(($action->getInventory() instanceof ChestInventory || $action->getInventory() instanceof DoubleChestInventory) && isset($this->cool[$player->getName()])){
          $ev->setCancelled(true);
                }
            }
        }
  }*/
}
