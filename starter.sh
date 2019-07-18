#!/bin/sh
case "$1" in
     "start")
        echo "Włączam boty!"
        for i in $(seq 1 2)
        do
            screen -AdmS dBot_$i php core.php -i $i
            sleep 0.2
        done
          ;;
     "stop")
        echo "Wyłączam boty!"
        for i in $(seq 1 2)
        do
            screen -X -S dBot_$i quit
        done
          ;;
     "restart")
        echo "Restartuje boty!"
        for i in $(seq 1 2)
        do
            screen -X -S dBot_$i quit
        done
        sleep 2
        for i in $(seq 1 2)
        do
            screen -AdmS dBot_$i php core.php -i $i
            sleep 0.2
        done

          ;; 
     *)
          echo "Użycie: starter.sh start/stop/restart"
          ;;
esac

