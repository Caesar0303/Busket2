<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $goods = 
        [
            [
                'name' => 'Apple',
                'cost' => 30,
                1 => 1,
                'count' => 0,
            ],
            [
                'name' => 'Orange',
                'cost' => 20,
                2 => 2,
                'count' => 0,
            ],
            [
                'name' => 'Banana',
                'cost' => 30,
                3 => 3,
                'count' => 0,
            ]
        ];
     ?>
     <table>
        <tbody>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Cost
                </th>
                <th>
                    Count
                </th>
            </tr>
            <?php 
                session_start();
                if($_GET['remove'] == true) {
                    session_unset();
                }
                $count=0;
                foreach($goods as $item){
                $i++;
                $c++;
            ?>
            <tr>
                <td><?= "<a href='?good_id=" . $i . "'>" . $item['name'] . "</a>" ?></td>
                <td><?= $item['cost'] ?></td>
                <?php
                    if ($_GET['good_id'] == $i) {
                        $_SESSION['busket'][$i] = 
                        [                                
                            'name' => $item['name'],
                            'cost' => $item['cost'],
                            'id' => $i,
                            'count' => NULL,
                        ];
                    }
                    if ($_GET['good_id'] == $i) {
                        $_SESSION['count'][$c]++;
                        $_SESSION['busket'][$i]['count'] = $_SESSION['count'][$c];
                    }
                    if ($_GET['remove_good'] == $_SESSION['busket'][$i]['id']) {
                        if ($_SESSION['busket'][$i]['count'] > 0 ) {
                            $_SESSION['busket'][$i]['count']--;
                            if($_SESSION['busket'][$i]['count'] == 0) {
                                unset($_SESSION['busket'][$i]);
                            }
                        }
                    }
                }
                ?>
                <td>
                <?php 
                ?>
            </tr>
        </tbody>
     </table>
            <?php
            echo '<a href = "?trigger=true">Обновить</a>';
            echo '<a href = "?remove=true">Удалить сессию</a>';
            ?>
    <table>
        <tbody>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Cost
                </th>
                <th>
                    Count
                </th>
            </tr>
            <?php
                if (isset($_SESSION['busket'])) {
                    $length = count($_SESSION['busket']);
                }
                for ($i = 1; $i < count($goods) + 1;$i++) {
            ?>
            <tr>
                    <td><?= $_SESSION['busket'][$i]['name']?></td>
                    <td><?= $_SESSION['busket'][$i]['cost']?></td>
                    <td><?= $_SESSION['busket'][$i]['count']?></td>
                    <td><?php echo "<a href='?remove_good=" . $_SESSION['busket'][$i]['id'] . "'>Удалить товар</a>";
                        
                    ?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
     </table>
</body>
</html>