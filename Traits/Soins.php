<?php

trait Soins {
    
    /**
     * Restaure les points de vie d’un Pokémon au maximum.
     */
    public function soigner() {
        $this->hp = $this->maxHp;
    }
}

