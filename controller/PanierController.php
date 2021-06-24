<?php


    include_once '../model/item.php';
    session_start();

    function showItems() {
        $item = new Item();
        $nb = 0;
        foreach($item->getAllItems() as $key => $value){
            echo '<div class="article">';
            echo '<h2>'.'Console : '.$key.'</h2>';
            foreach($value as $key1 => $value1) {
                if ($key1 ==='price') {
                    echo '<h3>'.$key1.' : '.$value1.' €</h3>';
                } else {
                    echo '<img class="logo" src="'.$value1.'">';
                    echo '<br>';
                    echo '<form method="POST" action="../view/accueil.php"">';
                    echo '<button type="submit" name="addPanier'.$nb.'" class="add">Ajouter au panier</button>';
                    echo '</form>';
                }
            }
            echo'</div>';
            $nb++;
        }
        echo '</div>';
    }

    function showPanier() {
        $item = new Item();
        $somme = 0;
        foreach ($_SESSION as $key => $quantity){
            $itemIndex = substr($key, 4, strlen($key));
            $arrayKeys = array_keys($item->getAllItems());
            $selectedConsole = $arrayKeys[$itemIndex];
            if($quantity > 0) {
                echo '<div class="article">';
                echo '<h2>'.'Console : '.$selectedConsole.'</h2>';
                echo 'Quantité : '.$quantity;
                echo '<form method="GET" action="../view/panier.php">';
                echo 'Prix : '.$item->getAllItems()[$selectedConsole]['price'].' €';
                $somme+=$item->getAllItems()[$selectedConsole]['price']*$quantity;
                echo '<img class="logo" src="'.$item->getAllItems()[$selectedConsole]['logo'].'">';
                echo '<button type="submit" name="deleteItem'.$itemIndex.'" class="delete">Supprimer</button>';
                echo'</form>';
                echo '</div>';

            }
        }
        echo '</div>';
        echo '<div class="somme">';
        echo '<h3>Le montant de votre panier est de : '.$somme.' €</h3>';
        echo '</div>';
        echo '</div>';


    }


    function addPanier()
    {
        $item = new Item();
        $itemIndex = 0;

        foreach ($_POST as $content => $empty) {
            $itemIndex = substr($content, strlen('addPanier'), strlen($content));
            $arrayKeys = array_keys($item->getAllItems());
        }

        if (!isset($_SESSION['item' . $itemIndex])) {
            $_SESSION['item' . $itemIndex] = 1;
        } else {
            $_SESSION['item' . $itemIndex] += 1;
        }

        header('location:../view/accueil.php');
    }

    function deletePanier() {
        $item = new Item();

        $itemIndex = 0;

        foreach ($_GET as $content => $empty) {
            $itemIndex = substr($content, strlen('itemDelete'), strlen($content));
            $arrayKeys = array_keys($item->getAllItems());
        }

        if(isset($_SESSION['item'.$itemIndex])) {
            $_SESSION['item'.$itemIndex] -= 1;
            if ($_SESSION['item'.$itemIndex] == 0) {
                unset($_SESSION['item'.$itemIndex]);
            }
        }

        header('location:panier.php');
    }

    function viderPanier() {
        $_SESSION = [];
        header('location:panier.php');
        session_destroy();
    }

