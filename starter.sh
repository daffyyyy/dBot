#!/bin/sh
case "$1" in
     "start")
        echo "Włączam boty!"
        for i in $(seq 1 3)
        do
            screen -AdmS dBot_$i php core.php -i $i
            sleep 0.2
        done
        screen -AdmS dBot_status php status.php
          ;;
     "stop")
        echo "Wyłączam boty!"
        for i in $(seq 1 3)
        do
            screen -X -S dBot_$i quit
        done
        screen -X -S dBot_status quit
          ;;
     "restart")
        echo "Restartuje boty!"
        for i in $(seq 1 3)
        do
            screen -X -S dBot_$i quit
        done
        screen -X -S dBot_status quit
        sleep 2
        for i in $(seq 1 3)
        do
            screen -AdmS dBot_$i php core.php -i $i
            sleep 0.2
        done
        screen -AdmS dBot_status php status.php

          ;; 
     *)
          echo "Użycie: starter.sh start/stop/restart"
          ;;
esac

