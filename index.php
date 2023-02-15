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
                'id' => 1,
                'count' => 0,
            ],
            [
                'name' => 'Orange',
                'cost' => 20,
                'id' => 2,
                'count' => 0,
            ],
            [
                'name' => 'Banana',
                'cost' => 30,
                'id' => 3,
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
                foreach($goods as $item){
                $i++;
            ?>
            <tr>
                <td><?= "<a href='?good_id=" . $i . "'>" . $item['name'] . "</a>" ?></td>
                <td><?= $item['cost'] ?></td>
                <?php
                    if ($_GET['good_id'] == $i) {
                        $busket = [
                            [
                                'name' => $item['name'],
                                'cost' => $item['cost'],
                                'id' => $i,
                                'count' => 0,
                            ],
                        ];
                        $_SESSION['busket'][] = $busket;
                        }
                    }
                    var_dump($_SESSION['busket']);
                ?>
                <td><?= '<input type="number" name="input">' ?>
            </tr>
        </tbody>
     </table>
            <?php
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
                for ($i = 0; $i < $length;$i++) {
            ?>
            <tr>
                    <td><?= $_SESSION['busket'][$i][0]['name']?></td>
                    <td><?= $_SESSION['busket'][$i][0]['cost']?></td>
                    <td><?= $_SESSION['busket'][$i][0]['count']?></td>
                    <td><?php echo "<a href='?remove_good=" . $_SESSION['busket'][$i][0]['id'] . "'>Удалить товар</a>";
                        if ($_GET['remove_good'] == $_SESSION['busket'][$i][0]['id']) {
                            unset($_SESSION['busket'][$i]);
                        }
                    ?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
     </table>
</body>
</html>