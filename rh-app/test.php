<ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-primary">
                <div style="width:90px;">
                Employés
                </div>
                <span></span>
                <span>? Operation</span>
                
            </li>
            <?php foreach($res as $item){ ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div style="width:90px;">
                <?php echo $item['Name']; ?>
                </div>
                <span></span>
                
                <span>
                <span><a class="btn btn-primary" href="infoemp.php?id=<?=$item['ID'];?>">Détails</a>
                <a class="btn btn-primary" href="delete.php?deleteuser=1&id=<?=$item["ID"];?>">Supprimer</a></span>
                
                </span>
            </li>
            <?php } ?>
            <div class="jumbotron mt-3">
                <a class="btn btn-lg btn-primary" href="addrespo.php" role="button">+</a>
            </div>
        </ul>