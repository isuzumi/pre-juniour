<?php
require_once "player.php";

class tournament
{
    private $name;
    private $date;
    private $players;

    public function __construct($name, $date = false)
    {
        $this->name = $name;
        
        if($date === false){
            $this->date = new DateTime() ;
        } else {
            $this->date = DateTime::createFromFormat("Y.m.d", $date);
        }
    }

    public function addPlayer($player)
    {
        $this->players[] = $player;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function createPairs()
    {
        //Создать игрока заглушку если количество игроков нечетное
        if( !(count($this->players) % 2 === 0) ){
            array_push($this->players,new Player("fake"));
        }

        //Запомнить первого и удалить его из массива
        $notMove = array_shift($this->players);
        foreach ($this->players as $player){
            //Запомнить порядок игроков для вывода пар
            $leftPlaers[] = array_merge([$notMove],$this->players);
            $rightPlaers[] = array_reverse( array_merge([$notMove],$this->players ));
            
            //двигаем игроков по часовой стрелке
            $last = array_pop($this->players);
            array_unshift($this->players,$last);
        }

        //Обрезаем массив пополам для вывода
        for($i=0; $i<count($leftPlaers[0])-1; $i++){
            $this->date->modify('+1 day');
            echo "{$this->getName()}, {$this->date->format('d.m.Y')}<br>"; 
            for($j=0; $j<count($rightPlaers[0])/2; $j++){
                //Не выводим игрока заглушку
                if( $leftPlaers[$i][$j]->getName() !="fake" && $rightPlaers[$i][$j]->getName() != "fake"){
                    echo "{$leftPlaers[$i][$j]->getName()} {$leftPlaers[$i][$j]->getCity()}
                     -  
                    {$rightPlaers[$i][$j]->getName()} {$rightPlaers[$i][$j]->getCity()}
                    <br>";
                }
            }
            echo "<br>";
        } 
    }
}







