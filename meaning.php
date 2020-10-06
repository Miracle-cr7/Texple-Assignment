<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/css/compiled-4.17.0.min.css?ver=4.17.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="mir.css">
    <title>PHP SAMPLE</title>
</head>

<body>
    <div class="container" style="margin-bottom: 30px">
        <div>
            <h1 style="text-align: center; color: darkblue">Word Finder</h1>
        </div>
        <form method="GET" action="" class='pads'>
            <div class="row">
                <div class="col-sm-8 col-md-6 input-group" style="padding: 40px 0;">
                    <input type="text" name="word" class="form-control" id="search" style="border-radius: 20px 0 0 20px; border-left: none;" placeholder="Try another word" />
                    <button class="xt" type="submit">
                        🔍
                    </button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-sm-10 offset-sm-1 ui-box">

                <?php
                $url = "https://owlbot.info/api/v4/dictionary/" . $_GET["word"];
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Token a3022b2a33f58b0a3513c205e6a605a01bfb09f9']);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                $response = curl_exec($curl);
                $response_json = json_decode($response, JSON_PRETTY_PRINT);
                $response_json;


                if ($response_json) {
                    echo '<script>document.querySelector(".ui-box").style.border="solid 1px lightgrey"</script>';
                    echo '<script>document.querySelector(".ui-box").style.border-radius="0 20px 20px 0"</script>';
                    echo '<script>document.querySelector(".ui-box").style.z-index="999"</script>';
                }
                ?>
                <h3 class="word-text">
                    <?php echo $_GET['word']; ?>
                </h3>
                <span class="pronunciation-text" style="color: #808080;">
                    <?php
                    if ($response_json['pronunciation']) {
                        echo '/' . $response_json['pronunciation'] . '/';
                    } ?>
                </span>
                <?php
                $i = 0;
                foreach ($response_json['definitions'] as $z) {
                    $string = $response_json['definitions'][$i]; ?>
                    <div id="definitions-container">
                        <div class="row" style="border-top: solid 1px #e6e6e6; padding: 10px 0">
                            <div class="col-sm-9 my-auto">

                                <em>
                                    <?php
                                    $img = $string['image_url'];
                                    if ($string['type']) {
                                        echo 'Figure of speech - ' . $string['type'];
                                    } ?>
                                </em><br>
                                <?php
                                if ($string['definition']) {
                                    echo 'Definition - ' . $string['definition'] . $string['emogi'];
                                } ?>
                                <br><span style="color: #808080; font-size: 14px;">
                                    <?php
                                    if ($string['example']) {
                                        echo 'Example - "' . $string['example'] . '"';
                                    } ?>
                                </span>

                            </div>
                            <div class="col-sm-3 text-right">
                                <?php
                                if ($img) {
                                    echo "<img src=" . $img . " class = img1 alt= No image found />";
                                }
                                $i++;
                                ?>
                            </div>
                        </div>
                    </div>
                <?php }
                curl_close($curl); ?>
            </div>
        </div>
    </div>

    <div class="text-center main">
        <a class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#orangeModalSubscription" aria-pressed="true">ToDo List</a>
    </div>

    <div class="modal" id="orangeModalSubscription" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action='process.php' method='POST' class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel">Sign In</h3>
                    <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                </div>
                <div class="modal-body">
                    <div class="md-form1">
                        <input name='pass' type="password" class="form-control">
                        <label data-error="wrong" data-success="right" for="Formail" class>Root Password</label>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn1" type="submit">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        Confirm
                    </button>
                </div>
            </form>
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>